<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewService extends ViewRecord
{
    protected static string $resource = ServiceResource::class;

    public function getTitle(): string
    {
        return 'مشاهده خدمت: ' . $this->record->title;
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('ویرایش این خدمت')
                ->icon('heroicon-o-pencil-square'),

            Action::make('back')
                ->label('بازگشت به لیست')
                ->icon('heroicon-o-arrow-right')
                ->color('gray')
                ->url($this->getResource()::getUrl('index')),
        ];
    }
}
