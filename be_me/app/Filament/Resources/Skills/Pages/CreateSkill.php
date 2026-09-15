<?php

namespace App\Filament\Resources\Skills\Pages;

use App\Filament\Resources\Skills\SkillResource;
use App\Models\Skill;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateSkill extends CreateRecord
{
    protected static string $resource = SkillResource::class;

    /**
     * هدایت به صفحه لیست مهارت‌ها بعد از ایجاد موفق
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * شخصی‌سازی نوتیفیکیشن ثبت رکورد
     */
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('مهارت جدید ثبت شد')
            ->body('تکنولوژی با موفقیت به لیست مهارت‌های پورتفولیو اضافه گردید.');
    }

    /**
     * تنظیم خودکار ترتیب نمایش در صورت خالی بودن
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['name'] = trim($data['name']);

        if (empty($data['sort_order'])) {
            $data['sort_order'] = (Skill::max('sort_order') ?? 0) + 1;
        }

        return $data;
    }
}
