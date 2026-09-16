<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use App\Models\Project;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('پروژه ذخیره شد')
            ->body('پروژه جدید با موفقیت به پورتفولیو اضافه شد.');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['sort_order'])) {
            $data['sort_order'] = (Project::max('sort_order') ?? 0) + 1;
        }

        return $data;
    }
}
