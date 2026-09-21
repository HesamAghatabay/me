<?php

namespace App\Filament\Resources\Skills\Pages;

use App\Filament\Resources\Skills\SkillResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Jobs\TranslateModelJob;

class EditSkill extends EditRecord
{
    protected static string $resource = SkillResource::class;

    protected function afterSave(): void
    {
        TranslateModelJob::dispatch($this->record);
    }
    protected function getHeaderActions(): array
    {
        return [
            // دکمه بازگشت سریع به لیست مهارت‌ها
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

    /**
     * هدایت به لیست مهارت‌ها پس از ویرایش موفق
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * شخصی‌سازی نوتیفیکیشن ویرایش موفق
     */
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('تغییرات با موفقیت ذخیره شد')
            ->body('اطلاعات مهارت به‌روزرسانی گردید.');
    }

    /**
     * پاک‌سازی فضاهای خالی نام قبل از ذخیره
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['name'] = trim($data['name']);

        return $data;
    }
}
