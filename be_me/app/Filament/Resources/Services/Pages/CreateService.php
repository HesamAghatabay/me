<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use App\Models\Service;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('خدمت جدید ثبت شد')
            ->body('خدمت مورد نظر با موفقیت در سیستم تعریف گردید.');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['title'] = trim($data['title']);

        if (empty($data['sort_order'])) {
            $data['sort_order'] = (Service::max('sort_order') ?? 0) + 1;
        }

        return $data;
    }
}
