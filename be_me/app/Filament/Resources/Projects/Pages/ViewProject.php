<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    public function getTitle(): string
    {
        return 'مشاهده پروژه: ' . $this->record->title;
    }

    protected function getHeaderActions(): array
    {
        return [
            // باز کردن لینک دمو در تب جدید (در صورت وجود)
            Action::make('open_demo')
                ->label('مشاهده دموی آنلاین')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('info')
                ->url(fn (): ?string => $this->record->demo_url)
                ->openUrlInNewTab()
                ->visible(fn (): bool => filled($this->record->demo_url)),

            // ویرایش پروژه
            EditAction::make()
                ->label('ویرایش پروژه')
                ->icon('heroicon-o-pencil-square'),

            // دکمه بازگشت به لیست
            Action::make('back')
                ->label('بازگشت به لیست')
                ->icon('heroicon-o-arrow-right')
                ->color('gray')
                ->url($this->getResource()::getUrl('index')),
        ];
    }
}
