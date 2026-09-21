<?php

namespace App\Filament\Resources\Skills\Pages;

use App\Filament\Resources\Skills\SkillResource;
use App\Jobs\TranslateModelJob;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditSkill extends EditRecord
{
    protected static string $resource = SkillResource::class;

    /**
     * استخراج متن فارسی قبل از پر شدن اینپوت برای جلوگیری از نمایش [object Object]
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['name'] = $this->record->getTranslation('name', 'fa', false) ?? '';

        return $data;
    }

    /**
     * پاک‌سازی فاصله‌های اضافی قبل از ذخیره
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['name']) && is_string($data['name'])) {
            $data['name'] = trim($data['name']);
        }

        return $data;
    }

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
            ->title('تغییرات با موفقیت ذخیره شد')
            ->body('اطلاعات مهارت به‌روزرسانی گردید.');
    }
}
