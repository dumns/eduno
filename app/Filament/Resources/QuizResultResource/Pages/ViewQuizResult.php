<?php

namespace App\Filament\Resources\QuizResultResource\Pages;

use App\Filament\Resources\QuizResultResource;
use Filament\Resources\Pages\ViewRecord;
use App\Models\QuizAnswer;
use Filament\Infolists;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\RepeatableEntry;

class ViewQuizResult extends ViewRecord
{
    protected static string $resource = QuizResultResource::class;

}
