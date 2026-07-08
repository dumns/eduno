<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizResultResource\Pages;
use App\Models\QuizAnswer;
use App\Models\QuizAttempt;
use App\Models\QuizResult;
use Filament\Forms;
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizResults::route('/'),
            'view' => Pages\ViewQuizResult::route('/{record}'),
        ];
    }
}
