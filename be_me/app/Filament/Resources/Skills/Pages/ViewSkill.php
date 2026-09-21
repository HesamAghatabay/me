<?php

namespace App\Filament\Resources\Skills\Pages;

use App\Filament\Resources\Skills\SkillResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSkill extends ViewRecord
{
    protected static string $resource = SkillResource::class;

    /**
     * تنظیم عنوان صفحه بر اساس نام رکورد فعلی
     */
    public function getTitle(): string
{
    $name = $this->record->getTranslation('name', 'fa') ?? $this->record->name;

    return 'مشاهده مهارت: ' . $name;
}
    protected function getHeaderActions(): array
    {
        return [
            // دکمه ویرایش مستقیم رکورد
            EditAction::make()
                ->label('ویرایش این مهارت')
                ->icon('heroicon-o-pencil-square'),

            // دکمه بازگشت به لیست
            Action::make('back')
                ->label('بازگشت به لیست')
                ->icon('heroicon-o-arrow-right')
                ->color('gray')
                ->url($this->getResource()::getUrl('index')),
        ];
    }
}
