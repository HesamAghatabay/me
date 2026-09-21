<?php

namespace App\Filament\Resources\Experiences\Pages;

use App\Filament\Resources\Experiences\ExperienceResource;
use App\Jobs\TranslateModelJob;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditExperience extends EditRecord
{
    protected static string $resource = ExperienceResource::class;

    /**
     * استخراج متن خالص فارسی فیلدهای ترجمه‌پذیر قبل از پر شدن فرم
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['role'] = $this->record->getTranslation('role', 'fa', false) ?? '';
        $data['company'] = $this->record->getTranslation('company', 'fa', false) ?? '';
        $data['employment_type'] = $this->record->getTranslation('employment_type', 'fa', false) ?? '';
        $data['description'] = $this->record->getTranslation('description', 'fa', false) ?? '';

        return $data;
    }

    /**
     * پاک‌سازی و مدیریت فیلدها قبل از ذخیره‌سازی
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (! empty($data['is_current'])) {
            $data['end_date'] = null;
        }

        if (isset($data['role']) && is_string($data['role'])) {
            $data['role'] = trim($data['role']);
        }

        if (isset($data['company']) && is_string($data['company'])) {
            $data['company'] = trim($data['company']);
        }

        return $data;
    }

    /**
     * ارسال رکورد به صف ترجمه هوش مصنوعی پس از ویرایش موفق
     */
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
}
