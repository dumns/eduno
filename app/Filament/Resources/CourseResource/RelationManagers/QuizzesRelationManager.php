<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class QuizzesRelationManager extends RelationManager
{
    protected static string $relationship = 'quizzes';

    public function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
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
                    ->collapsible()
                    ->orderable()
            ]);
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
