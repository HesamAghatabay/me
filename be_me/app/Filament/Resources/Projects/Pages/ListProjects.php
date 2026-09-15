<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected static ?string $title = 'مدیریت پروژه‌ها';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('ثبت پروژه جدید')
                ->icon('heroicon-o-plus-circle'),
        ];
    }
}
