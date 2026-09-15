<?php

namespace App\Filament\Resources\Experiences\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class ExperienceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('اطلاعات سابقه شغلی')
                    ->schema([
                        TextInput::make('company')
                            ->label('نام شرکت / سازمان')
                            ->required()
                            ->maxLength(120),

                        TextInput::make('role')
                            ->label('عنوان سمت شغلی')
                            ->placeholder('مثلاً: برنامه‌نویس ارشد لاراول')
                            ->required()
                            ->maxLength(120),

                        DatePicker::make('start_date')
                            ->label('تاریخ شروع')
                            ->required()
                            ->native(false),

                        DatePicker::make('end_date')
                            ->label('تاریخ پایان')
                            ->native(false)
                            ->disabled(fn (Get $get): bool => (bool) $get('is_current'))
                            ->required(fn (Get $get): bool => ! (bool) $get('is_current')),

                        Toggle::make('is_current')
                            ->label('همچنان در این موقعیت شغلی مشغول به کار هستم')
                            ->live()
                            ->default(false),

                        TextInput::make('sort_order')
                            ->label('ترتیب نمایش')
                            ->numeric()
                            ->default(0),

                        Textarea::make('description')
                            ->label('شرح وظایف و دستاوردها')
                            ->placeholder('دستاوردهای فنی، پروژه‌های پیاده‌سازی‌شده و مهارت‌های مورد استفاده...')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
