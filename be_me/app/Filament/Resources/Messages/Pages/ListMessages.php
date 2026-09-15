<?php

namespace App\Filament\Resources\Messages\Pages;

use App\Filament\Resources\Messages\MessageResource;
use Filament\Resources\Pages\ListRecords;

class ListMessages extends ListRecords
{
    protected static string $resource = MessageResource::class;

    protected static ?string $title = 'صندوق پیام‌های تماس';

    protected function getHeaderActions(): array
    {
        return [];
    }
}
