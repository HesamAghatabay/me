<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('اطلاعات خدمت')
                    ->schema([
                        TextEntry::make('title')
                            ->label('عنوان خدمت'),

                        TextEntry::make('sort_order')
                            ->label('ترتیب نمایش'),

                        TextEntry::make('description')
                            ->label('توضیحات کامل')
                            ->columnSpanFull(),

                        TextEntry::make('created_at')
                            ->label('تاریخ ثبت')
                            ->dateTime(),

                        TextEntry::make('updated_at')
                            ->label('آخرین ویرایش')
                            ->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }
}
