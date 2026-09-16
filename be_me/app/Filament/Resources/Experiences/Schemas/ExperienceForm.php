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
            ->columns(3)
            ->components([
                // ستون اصلی: مشخصات شرکت و شرح دستاوردها
                Section::make('مشخصات و شرح موقعیت شغلی')
                    ->description('عنوان شرکت، سمت کاری و جزئیات فعالیت‌ها')
                    ->schema([
                        TextInput::make('company')
                            ->label('نام شرکت / سازمان')
                            ->placeholder('مثلاً: شرکت فناوری پیشرو')
                            ->required()
                            ->maxLength(120),

                        TextInput::make('role')
                            ->label('عنوان سمت شغلی')
                            ->placeholder('مثلاً: برنامه‌نویس ارشد لاراول')
                            ->required()
                            ->maxLength(120),

                        Textarea::make('description')
                            ->label('شرح وظایف و دستاوردها')
                            ->placeholder('دستاوردهای فنی، پروژه‌های پیاده‌سازی‌شده و تکنولوژی‌های مورد استفاده...')
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                // ستون کناری: بازه زمانی، وضعیت اشتغال و اولویت
                Section::make('دوره زمانی و وضعیت')
                    ->description('تاریخ همکاری و ترتیب نمایش در تایم‌لاین')
                    ->schema([
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
                            ->label('مشغول به کار فعلی')
                            ->helperText('در صورت فعال بودن، تاریخ پایان غیرفعال می‌شود')
                            ->live()
                            ->default(false),

                        TextInput::make('sort_order')
                            ->label('ترتیب نمایش')
                            ->numeric()
                            ->default(0)
                            ->helperText('ترتیب قرارگیری در تایم‌لاین رزومه'),
                    ])
                    ->columnSpan(1),
            ]);
    }
}
