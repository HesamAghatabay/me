<?php

namespace App\Filament\Resources\Messages\Pages;

use App\Filament\Resources\Messages\MessageResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewMessage extends ViewRecord
{
    protected static string $resource = MessageResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (! $this->record->is_read) {
            $this->record->update(['is_read' => true]);
        }

        return $data;
    }

    public function getTitle(): string
    {
        return 'پیام از طرف: ' . $this->record->name;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('reply')
                ->label('پاسخ با ایمیل')
                ->icon('heroicon-o-envelope')
                ->color('primary')
                ->url(fn (): string => 'mailto:' . $this->record->email . '?subject=Re: ' . urlencode($this->record->subject)),

            Action::make('back')
                ->label('بازگشت به لیست')
                ->icon('heroicon-o-arrow-right')
                ->color('gray')
                ->url($this->getResource()::getUrl('index')),
        ];
    }
}
