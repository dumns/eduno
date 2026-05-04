<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question')
                    ->label('Pertanyaan')
                    ->required(),
                Forms\Components\Select::make('type')
                    ->label('Tipe Soal')
                    ->options([
                        'multiple_choice' => 'Multiple Choice',
                        'essay' => 'Essay',
                    ])
                    ->required(),
                Forms\Components\Toggle::make('is_multiple_answer')
                    ->label('Boleh lebih dari satu jawaban benar?')
                    ->helperText('Aktifkan jika soal ini memiliki lebih dari satu jawaban benar (multiple answer).')
                    ->default(false)
                    ->visible(fn($get) => $get('type') === 'multiple_choice'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question')->label('Pertanyaan')->limit(40),
                Tables\Columns\BadgeColumn::make('type')->label('Tipe'),
                Tables\Columns\IconColumn::make('is_multiple_answer')
                    ->boolean()
                    ->label('Multi Jawaban'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\OptionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
