<?php

namespace App\Filament\Resources\Experiences\Pages;

use App\Filament\Resources\Experiences\ExperienceResource;
use App\Models\Experience;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Jobs\TranslateModelJob;

class CreateExperience extends CreateRecord
{
    protected static string $resource = ExperienceResource::class;


    protected function afterCreate(): void
    {
        TranslateModelJob::dispatch($this->record);
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('سابقه شغلی جدید اضافه شد')
            ->body('رکورد تجربیات کاری با موفقیت ثبت شد.');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (! empty($data['is_current'])) {
            $data['end_date'] = null;
        }

        if (empty($data['sort_order'])) {
            $data['sort_order'] = (Experience::max('sort_order') ?? 0) + 1;
        }

        return $data;
    }
}
