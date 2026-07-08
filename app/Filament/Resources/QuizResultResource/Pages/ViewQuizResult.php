<?php

namespace App\Filament\Resources\QuizResultResource\Pages;

use App\Filament\Resources\QuizResultResource;
use App\Models\QuizAnswer;
use App\Models\QuizResult;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewQuizResult extends ViewRecord
{
    protected static string $resource = QuizResultResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Ringkasan')
                    ->schema([
                        TextEntry::make('quiz.title')->label('Quiz'),
                        TextEntry::make('user.name')->label('User'),
                        TextEntry::make('score')->label('Skor'),
                        TextEntry::make('max_score')->label('Skor Maksimal'),
                        TextEntry::make('percentage')
                            ->label('Persentase')
                            ->formatStateUsing(fn ($state) => number_format($state, 1) . ' %'),
                        TextEntry::make('created_at')->label('Waktu Submit')->dateTime('d M Y H:i'),
                    ])
                    ->columns(3),
                Section::make('Jawaban')
                    ->schema([
                        RepeatableEntry::make('answers')
                            ->hiddenLabel()
                            ->state(fn (QuizResult $record) => static::buildAnswerRows($record))
                            ->schema([
                                TextEntry::make('question')->label('Soal')->columnSpanFull(),
                                TextEntry::make('type')->label('Tipe'),
                                TextEntry::make('user_answer')->label('Jawaban User'),
                                TextEntry::make('correct_answer')->label('Jawaban Benar'),
                                IconEntry::make('is_correct')
                                    ->label('Benar?')
                                    ->boolean(),
                            ])
                            ->columns(4),
                    ]),
            ]);
    }

    protected static function buildAnswerRows(QuizResult $record): array
    {
        $questions = $record->quiz->questions()->with('options')->orderBy('id')->get();

        $answers = QuizAnswer::where('quiz_id', $record->quiz_id)
            ->where('user_id', $record->user_id)
            ->get()
            ->keyBy('question_id');

        return $questions->map(function ($question) use ($answers) {
            $userAnswerRaw = $answers->get($question->id)?->answer;
            $userAnswerText = '(Tidak dijawab)';
            $correctAnswerText = '-';
            $isCorrect = false;

            if ($question->type === 'multiple_choice') {
                $correctOption = $question->options->firstWhere('is_correct', true);
                $correctAnswerText = $correctOption->option ?? '-';

                if ($userAnswerRaw !== null) {
                    $chosenOption = $question->options->firstWhere('id', (int) $userAnswerRaw);
                    $userAnswerText = $chosenOption->option ?? '(Opsi sudah tidak tersedia)';
                    $isCorrect = (bool) ($chosenOption?->is_correct);
                }
            } else {
                $correctAnswerText = $question->answer;

                if ($userAnswerRaw !== null) {
                    $userAnswerText = $userAnswerRaw;
                    $isCorrect = trim(strtolower($userAnswerRaw)) === trim(strtolower((string) $question->answer));
                }
            }

            return [
                'question' => $question->question,
                'type' => $question->type === 'multiple_choice' ? 'Pilihan Ganda' : 'Isian',
                'user_answer' => $userAnswerText,
                'correct_answer' => $correctAnswerText,
                'is_correct' => $isCorrect,
            ];
        })->toArray();
    }
}
