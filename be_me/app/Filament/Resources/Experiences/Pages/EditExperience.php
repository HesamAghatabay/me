<?php

namespace App\Filament\Resources\Experiences\Pages;

use App\Filament\Resources\Experiences\ExperienceResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Jobs\TranslateModelJob;

class EditExperience extends EditRecord
{
    protected static string $resource = ExperienceResource::class;

    protected function afterSave(): void
    {
        TranslateModelJob::dispatch($this->record);
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('بازگشت به لیست')
                ->icon('heroicon-o-arrow-right')
                ->color('gray')
                ->url($this->getResource()::getUrl('index')),

            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('تغییرات ذخیره شد')
            ->body('سابقه شغلی به‌روزرسانی شد.');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (! empty($data['is_current'])) {
            $data['end_date'] = null;
        }

        return $data;
    }
}
