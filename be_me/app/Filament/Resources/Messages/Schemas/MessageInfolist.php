<?php

namespace App\Filament\Resources\Messages\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MessageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('بررسی پیام تماس')
                    ->schema([
                        TextEntry::make('name')
                            ->label('نام فرستنده'),

                        TextEntry::make('email')
                            ->label('ایمیل فرستنده')
                            ->copyable(),

                        TextEntry::make('subject')
                            ->label('موضوع پیام')
                            ->columnSpanFull(),

                        TextEntry::make('content')
                            ->label('متن پیام')
                            ->columnSpanFull(),

                        IconEntry::make('is_read')
                            ->label('وضعیت خوانده‌شده')
                            ->boolean(),

                        TextEntry::make('created_at')
                            ->label('تاریخ و زمان ارسال')
                            ->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }
}
