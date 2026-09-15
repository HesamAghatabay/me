<?php

namespace App\Filament\Resources\Experiences\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ExperienceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('جزئیات موقعیت شغلی')
                    ->schema([
                        TextEntry::make('company')
                            ->label('شرکت'),

                        TextEntry::make('role')
                            ->label('سمت'),

                        TextEntry::make('start_date')
                            ->label('تاریخ شروع')
                            ->date(),

                        TextEntry::make('end_date')
                            ->label('تاریخ پایان')
                            ->date()
                            ->placeholder('تا کنون'),

                        IconEntry::make('is_current')
                            ->label('شغل فعلی')
                            ->boolean(),

                        TextEntry::make('sort_order')
                            ->label('ترتیب نمایش'),

                        TextEntry::make('description')
                            ->label('توضیحات و دستاوردها')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
