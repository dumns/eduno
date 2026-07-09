<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizResultResource\Pages;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizAttempt;
use App\Models\QuizResult;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuizResultResource extends Resource
{
    protected static ?string $model = QuizResult::class;
    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationLabel = 'Quiz Monitoring';
    protected static ?string $navigationGroup = 'Quiz';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('quiz.title')->label('Quiz'),
                Tables\Columns\TextColumn::make('user.name')->label('User'),
                Tables\Columns\TextColumn::make('score')->label('Score'),
                Tables\Columns\TextColumn::make('max_score')->label('Max'),
                Tables\Columns\TextColumn::make('percentage')->label('Percent')->formatStateUsing(fn($state) => number_format($state, 1) . ' %'),
                Tables\Columns\TextColumn::make('created_at')->label('Submitted')->dateTime('d M Y H:i'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\Action::make('export_csv')
                    ->label('Export CSV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->form([
                        Forms\Components\Select::make('course_id')
                            ->label('Course')
                            ->options(Course::query()->orderBy('title')->pluck('title', 'id'))
                            ->searchable()
                            ->required()
                            ->live(),
                        Forms\Components\Select::make('quiz_id')
                            ->label('Quiz')
                            ->options(fn (Get $get) => $get('course_id')
                                ? Quiz::where('course_id', $get('course_id'))->orderBy('title')->pluck('title', 'id')
                                : [])
                            ->searchable()
                            ->required()
                            ->disabled(fn (Get $get) => !$get('course_id'))
                            ->helperText('Pilih course terlebih dahulu.'),
                    ])
                    ->action(function (array $data) {
                        return static::exportQuizResultsCsv((int) $data['quiz_id']);
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('reset')
                    ->label('Reset')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Reset Percobaan Quiz')
                    ->modalDescription('Jawaban dan hasil user ini akan dihapus sehingga user dapat mengerjakan ulang quiz dari awal dengan waktu penuh (timer tidak dikurangi).')
                    ->action(function (QuizResult $record) {
                        QuizAnswer::where('quiz_id', $record->quiz_id)
                            ->where('user_id', $record->user_id)
                            ->delete();

                        QuizAttempt::where('quiz_id', $record->quiz_id)
                            ->where('user_id', $record->user_id)
                            ->delete();

                        $record->delete();

                        Notification::make()
                            ->title('Percobaan quiz berhasil direset')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    protected static function exportQuizResultsCsv(int $quizId)
    {
        $quiz = Quiz::with(['course', 'questions.options'])->find($quizId);

        if (!$quiz) {
            Notification::make()->title('Quiz tidak ditemukan')->danger()->send();
            return null;
        }

        $results = QuizResult::where('quiz_id', $quizId)
            ->with('user')
            ->orderBy('created_at')
            ->get();

        if ($results->isEmpty()) {
            Notification::make()->title('Belum ada hasil pengerjaan untuk quiz ini')->warning()->send();
            return null;
        }

        $questions = $quiz->questions;

        $header = [
            'No', 'Course', 'Quiz', 'Nama', 'Email', 'Skor', 'Skor Maksimal', 'Persentase (%)',
            'Jumlah Soal Dijawab', 'Total Soal', 'Boleh Mengulang', 'Timer Aktif', 'Durasi Timer (menit)',
            'Waktu Mulai Pengerjaan', 'Waktu Submit', 'Durasi Pengerjaan', 'Tanggal Submit Hasil',
        ];

        foreach ($questions as $i => $question) {
            $number = $i + 1;
            $header[] = "Soal {$number}: {$question->question}";
            $header[] = "Soal {$number} - Status";
        }

        $rows = [];

        foreach ($results as $index => $result) {
            $answers = QuizAnswer::where('quiz_id', $quizId)
                ->where('user_id', $result->user_id)
                ->get()
                ->keyBy('question_id');

            $attempt = $quiz->timer_enabled
                ? QuizAttempt::where('quiz_id', $quizId)->where('user_id', $result->user_id)->first()
                : null;

            $duration = null;
            if ($attempt && $attempt->started_at && $attempt->submitted_at) {
                $duration = $attempt->started_at->diff($attempt->submitted_at)->format('%H:%I:%S');
            }

            $row = [
                $index + 1,
                $quiz->course->title ?? '-',
                $quiz->title,
                $result->user->name ?? '-',
                $result->user->email ?? '-',
                $result->score,
                $result->max_score,
                number_format($result->percentage, 1),
                $answers->filter(fn ($a) => $a->answer !== null && $a->answer !== '')->count(),
                $questions->count(),
                $quiz->allow_multiple_attempts ? 'Ya' : 'Tidak',
                $quiz->timer_enabled ? 'Ya' : 'Tidak',
                $quiz->timer_enabled ? $quiz->duration_minutes : '-',
                $attempt?->started_at?->format('d-m-Y H:i:s') ?? '-',
                $attempt?->submitted_at?->format('d-m-Y H:i:s') ?? '-',
                $duration ?? '-',
                $result->created_at->format('d-m-Y H:i:s'),
            ];

            foreach ($questions as $question) {
                $answer = $answers->get($question->id);
                $userAnswerRaw = $answer?->answer;

                $userAnswerText = '(Tidak dijawab)';
                $status = 'Tidak Dijawab';

                if ($userAnswerRaw !== null && $userAnswerRaw !== '') {
                    if ($question->type === 'multiple_choice') {
                        $chosenOption = $question->options->firstWhere('id', (int) $userAnswerRaw);
                        $userAnswerText = $chosenOption->option ?? '(Opsi sudah tidak tersedia)';
                        $status = ($chosenOption?->is_correct) ? 'Benar' : 'Salah';
                    } else {
                        $userAnswerText = $userAnswerRaw;
                        $status = trim(strtolower($userAnswerRaw)) === trim(strtolower((string) $question->answer))
                            ? 'Benar'
                            : 'Salah';
                    }
                }

                $row[] = $userAnswerText;
                $row[] = $status;
            }

            $rows[] = $row;
        }

        $filename = 'hasil-quiz-' . str($quiz->title)->slug() . '-' . now()->format('Ymd-His') . '.csv';

        return response()->streamDownload(function () use ($header, $rows) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, $header);
            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizResults::route('/'),
            'view' => Pages\ViewQuizResult::route('/{record}'),
        ];
    }
}
