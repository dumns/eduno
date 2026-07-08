<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class QuizzesRelationManager extends RelationManager
{
    protected static string $relationship = 'quizzes';

    protected const CSV_OPTION_COLUMNS = ['option_1', 'option_2', 'option_3', 'option_4'];

    public function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                Toggle::make('allow_multiple_attempts')
                    ->label('User dapat mengisi quiz berkali-kali')
                    ->helperText('Jika nonaktif, user hanya bisa mengisi quiz satu kali.')
                    ->default(false),
                Toggle::make('timer_enabled')
                    ->label('Aktifkan Timer')
                    ->helperText('Jika aktif, user harus menyelesaikan quiz dalam batas waktu yang ditentukan.')
                    ->default(false)
                    ->live(),
                TextInput::make('duration_minutes')
                    ->label('Durasi Pengerjaan (menit)')
                    ->numeric()
                    ->minValue(1)
                    ->required(fn ($get) => $get('timer_enabled'))
                    ->visible(fn ($get) => $get('timer_enabled')),
                Actions::make([
                    Action::make('download_template')
                        ->label('Download Template CSV')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('gray')
                        ->action(fn () => static::downloadCsvTemplate()),
                    Action::make('import_csv')
                        ->label('Import dari CSV')
                        ->icon('heroicon-o-arrow-up-tray')
                        ->color('gray')
                        ->form([
                            FileUpload::make('csv_file')
                                ->label('File CSV')
                                ->required()
                                ->acceptedFileTypes(['text/csv', 'text/plain', 'application/vnd.ms-excel'])
                                ->disk('local')
                                ->directory('quiz-imports'),
                        ])
                        ->action(function (array $data, Set $set, Get $get) {
                            static::importQuestionsFromCsv($data['csv_file'], $set, $get);
                        }),
                ]),
                Repeater::make('questions')
                    ->relationship()
                    ->schema([
                        Textarea::make('question')->required()->label('Soal'),
                        Select::make('type')
                            ->options([
                                'multiple_choice' => 'Pilihan Ganda',
                                'essay' => 'Isian',
                            ])
                            ->required(),
                        Textarea::make('answer')
                            ->label('Jawaban Benar (untuk isian)')
                            ->visible(fn($get) => $get('type') === 'essay'),
                        Repeater::make('options')
                            ->relationship()
                            ->schema([
                                TextInput::make('option')->required()->label('Pilihan'),
                                Toggle::make('is_correct')->label('Jawaban Benar'),
                            ])
                            ->visible(fn($get) => $get('type') === 'multiple_choice'),
                    ])
                    ->label('Daftar Soal')
                    ->itemLabel(fn (array $state): ?string => $state['question'] ?? null)
                    ->collapsible()
                    ->orderable()
            ]);
    }

    protected static function downloadCsvTemplate()
    {
        $rows = [
            ['question', 'type', 'option_1', 'option_2', 'option_3', 'option_4', 'correct_option', 'essay_answer'],
            ['Apa ibukota Indonesia?', 'multiple_choice', 'Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Jakarta', ''],
            ['Sebutkan rumus luas lingkaran', 'essay', '', '', '', '', '', 'phi dikali r kuadrat'],
        ];

        return response()->streamDownload(function () use ($rows) {
            $handle = fopen('php://output', 'w');
            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }, 'template-soal-quiz.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }

    protected static function importQuestionsFromCsv(string $path, Set $set, Get $get): void
    {
        if (!Storage::disk('local')->exists($path)) {
            Notification::make()->title('File tidak ditemukan')->danger()->send();
            return;
        }

        [$rows, $skipped] = static::parseQuestionsCsv(Storage::disk('local')->path($path));

        Storage::disk('local')->delete($path);

        if (empty($rows)) {
            Notification::make()->title('Tidak ada soal valid yang ditemukan di CSV')->danger()->send();
            return;
        }

        $existing = $get('questions') ?? [];
        $set('questions', [...$existing, ...$rows]);

        Notification::make()
            ->title(count($rows) . ' soal berhasil diimpor' . ($skipped > 0 ? ", {$skipped} baris dilewati karena tidak valid" : ''))
            ->success()
            ->send();
    }

    /**
     * @return array{0: array<int, array<string, mixed>>, 1: int}
     */
    public static function parseQuestionsCsv(string $absolutePath): array
    {
        $handle = fopen($absolutePath, 'r');
        $header = $handle ? fgetcsv($handle) : false;

        if (!$header) {
            if ($handle) {
                fclose($handle);
            }
            return [[], 0];
        }

        $header = array_map(fn ($h) => strtolower(trim((string) $h)), $header);
        $rows = [];
        $skipped = 0;

        while (($line = fgetcsv($handle)) !== false) {
            if (count(array_filter($line, fn ($v) => trim((string) $v) !== '')) === 0) {
                continue;
            }

            $assoc = array_combine($header, array_pad($line, count($header), null));
            $question = trim((string) ($assoc['question'] ?? ''));
            $type = strtolower(trim((string) ($assoc['type'] ?? '')));

            if ($question === '' || !in_array($type, ['multiple_choice', 'essay'])) {
                $skipped++;
                continue;
            }

            if ($type === 'multiple_choice') {
                $correctOption = trim((string) ($assoc['correct_option'] ?? ''));
                $options = [];

                foreach (self::CSV_OPTION_COLUMNS as $column) {
                    $value = trim((string) ($assoc[$column] ?? ''));
                    if ($value === '') {
                        continue;
                    }

                    $options[] = [
                        'option' => $value,
                        'is_correct' => $correctOption !== '' && mb_strtolower($value) === mb_strtolower($correctOption),
                    ];
                }

                if (count($options) < 2) {
                    $skipped++;
                    continue;
                }

                $rows[] = [
                    'question' => $question,
                    'type' => 'multiple_choice',
                    'answer' => null,
                    'options' => $options,
                ];
            } else {
                $rows[] = [
                    'question' => $question,
                    'type' => 'essay',
                    'answer' => trim((string) ($assoc['essay_answer'] ?? '')),
                    'options' => [],
                ];
            }
        }

        fclose($handle);

        return [$rows, $skipped];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('questions_count')->counts('questions')->label('Jumlah Soal'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
