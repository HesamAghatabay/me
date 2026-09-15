<?php

namespace App\Filament\Resources\Skills\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SkillInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('جزئیات مهارت')
                    ->schema([
                        TextEntry::make('name')
                            ->label('نام تکنولوژی / مهارت'),

                        TextEntry::make('category')
                            ->label('دسته‌بندی')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'Frontend' => 'info',
                                'Backend' => 'success',
                                'DevOps' => 'warning',
                                'Database' => 'danger',
                                default => 'gray',
                            }),

                        IconEntry::make('in_ticker')
                            ->label('نمایش در نوار متحرک (Ticker)')
                            ->boolean(),

                        TextEntry::make('sort_order')
                            ->label('ترتیب نمایش'),

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
