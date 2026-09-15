<?php

namespace App\Filament\Resources\Messages\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('جزئیات پیام دریافتی')
                    ->schema([
                        TextInput::make('name')
                            ->label('نام فرستنده')
                            ->disabled(),

                        TextInput::make('email')
                            ->label('ایمیل فرستنده')
                            ->email()
                            ->disabled(),

                        TextInput::make('subject')
                            ->label('موضوع پیام')
                            ->disabled()
                            ->columnSpanFull(),

                        Textarea::make('content')
                            ->label('متن پیام')
                            ->disabled()
                            ->rows(6)
                            ->columnSpanFull(),

                        Toggle::make('is_read')
                            ->label('وضعیت: بررسی و خوانده شده')
                            ->helperText('آیا به این پیام پاسخ داده‌اید یا آن را بررسی کرده‌اید؟'),
                    ])
                    ->columns(2),
            ]);
    }
}
