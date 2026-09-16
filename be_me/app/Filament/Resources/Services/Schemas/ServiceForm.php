<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                // ستون اصلی: شرح و مشخصات خدمت
                Section::make('معرفی و شرح خدمت')
                    ->description('عنوان خدمت و ارزش افزوده‌ای که برای کارفرما ایجاد می‌کند')
                    ->schema([
                        TextInput::make('title')
                            ->label('عنوان خدمت')
                            ->placeholder('مثلاً: توسعه تخصصی وب‌اپلیکیشن')
                            ->required()
                            ->maxLength(120),

                        Textarea::make('description')
                            ->label('شرح جزئیات و خروجی کار')
                            ->placeholder('توضیح دهید این خدمت چه ارزشی خلق می‌کند و چگونه به مشتری کمک می‌کند...')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columnSpan(2),

                // ستون کناری: تنظیمات و اولویت‌بندی
                Section::make('تنظیمات نمایش')
                    ->description('موقعیت قرارگیری در کارت‌های صفحه اصلی')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('ترتیب نمایش')
                            ->placeholder('0')
                            ->numeric()
                            ->default(0)
                            ->helperText('عدد کمتر = اولویت نمایش بالاتر در ویترین'),
                    ])
                    ->columnSpan(1),
            ]);
    }
}
