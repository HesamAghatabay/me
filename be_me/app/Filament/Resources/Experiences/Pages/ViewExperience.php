<?php

namespace App\Filament\Resources\Experiences\Pages;

use App\Filament\Resources\Experiences\ExperienceResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewExperience extends ViewRecord
{
    protected static string $resource = ExperienceResource::class;

    public function getTitle(): string
    {
        $role = $this->record->getTranslation('role', 'fa') ?? $this->record->role;
        $company = $this->record->getTranslation('company', 'fa') ?? $this->record->company;

        return 'مشاهده سابقه: ' . $role . ' در ' . $company;
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('ویرایش این سابقه')
                ->icon('heroicon-o-pencil-square'),

            Action::make('back')
                ->label('بازگشت به لیست')
                ->icon('heroicon-o-arrow-right')
                ->color('gray')
                ->url($this->getResource()::getUrl('index')),
        ];
    }
}
