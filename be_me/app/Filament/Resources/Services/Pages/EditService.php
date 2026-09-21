<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use App\Jobs\TranslateModelJob;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    /**
     * استخراج متن خالص فارسی قبل از لود شدن فرم برای جلوگیری از خطای [object Object]
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['title'] = $this->record->getTranslation('title', 'fa', false) ?? '';
        $data['description'] = $this->record->getTranslation('description', 'fa', false) ?? '';

        return $data;
    }

    /**
     * تمیزکاری فضاهای خالی قبل از ذخیره
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['title']) && is_string($data['title'])) {
            $data['title'] = trim($data['title']);
        }

        return $data;
    }

    /**
     * ارسال مدل به صف ترجمه هوش مصنوعی پس از ذخیره
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
            ->body('اطلاعات خدمت به‌روزرسانی شد.');
    }
}
