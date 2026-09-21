<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use App\Jobs\TranslateModelJob;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    /**
     * تبدیل تمام مقادیر چندزبانه مدل به رشته قبل از پر شدن اینپوت‌های فرم
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['title'] = $this->record->getTranslation('title', 'fa', false) ?? '';
        $data['summary'] = $this->record->getTranslation('summary', 'fa', false) ?? '';

        $description = $this->record->getTranslation('description', 'fa', false);
        $data['description'] = is_string($description) ? $description : '';

        return $data;
    }

    /**
     * فراخوانی جاب هوش مصنوعی برای ترجمه پس از ذخیره فرم
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
            ->body('اطلاعات و کیس‌استدی پروژه به‌روزرسانی گردید.');
    }
}
