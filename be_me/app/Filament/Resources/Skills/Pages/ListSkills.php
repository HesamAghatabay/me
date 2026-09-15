<?php

namespace App\Filament\Resources\Skills\Pages;

use App\Filament\Resources\Skills\SkillResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSkills extends ListRecords
{
    protected static string $resource = SkillResource::class;

    protected static ?string $title = 'لیست مهارت‌ها و ابزارها';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('افزودن مهارت جدید')
                ->icon('heroicon-o-plus-circle'),
        ];
    }
}
