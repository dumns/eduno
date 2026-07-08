<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizResource\Pages;
use App\Filament\Resources\QuizResource\RelationManagers;
use App\Models\Quiz;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('course_id')
                    ->relationship('course', 'title')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Toggle::make('allow_multiple_attempts')
                    ->label('User dapat mengisi quiz berkali-kali')
                    ->helperText('Jika nonaktif, user hanya bisa mengisi quiz satu kali.')
                    ->default(false),
                Forms\Components\Toggle::make('timer_enabled')
                    ->label('Aktifkan Timer')
                    ->helperText('Jika aktif, user harus menyelesaikan quiz dalam batas waktu yang ditentukan.')
                    ->default(false)
                    ->live(),
                Forms\Components\TextInput::make('duration_minutes')
                    ->label('Durasi Pengerjaan (menit)')
                    ->numeric()
                    ->minValue(1)
                    ->required(fn (Forms\Get $get) => $get('timer_enabled'))
                    ->visible(fn (Forms\Get $get) => $get('timer_enabled')),
                Forms\Components\Toggle::make('show_result')
                    ->label('User dapat melihat nilai hasil pengerjaan')
                    ->helperText('Jika aktif, skor akan ditampilkan ke user setelah quiz disubmit.')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('course.title')->label('Course')->searchable(),
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
            RelationManagers\QuestionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
        ];
    }
}
