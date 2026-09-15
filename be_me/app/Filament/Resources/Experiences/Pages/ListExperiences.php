<?php

namespace App\Filament\Resources\Experiences\Pages;

use App\Filament\Resources\Experiences\ExperienceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExperiences extends ListRecords
{
    protected static string $resource = ExperienceResource::class;

    protected static ?string $title = 'سوابق کاری و تجربیات';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('افزودن سابقه کاری جدید')
                ->icon('heroicon-o-plus-circle'),
        ];
    }
}
