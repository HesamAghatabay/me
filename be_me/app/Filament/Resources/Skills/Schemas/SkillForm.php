<?php

namespace App\Filament\Resources\Skills\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SkillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                // ستون عریض مشخصات مهارت
                Section::make('مشخصات مهارت')
                    ->description('عنوان تکنولوژی و دسته‌بندی تخصصی آن را تعیین کنید')
                    ->schema([
                        TextInput::make('name')
                            ->label('نام تکنولوژی / مهارت')
                            ->placeholder('مثلاً: Laravel یا Vue.js')
                            ->required()
                            ->maxLength(80),

                        Select::make('category')
                            ->label('دسته‌بندی تخصصی')
                            ->placeholder('انتخاب حوزه تخصص...')
                            ->options([
                                'Frontend' => 'فرانت‌اند (Frontend)',
                                'Backend' => 'بک‌اند (Backend)',
                                'DevOps' => 'دواپس و سرور (DevOps)',
                                'Database' => 'دیتابیس (Database)',
                                'Tools' => 'ابزارها و فریم‌ورک‌ها (Tools)',
                            ])
                            ->required()
                            ->native(false)
                            ->searchable(),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                // ستون کناری تنظیمات و ویترین
                Section::make('تنظیمات ویترین')
                    ->description('موقعیت و شیوه نمایش در سایت')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('ترتیب نمایش')
                            ->numeric()
                            ->default(0)
                            ->helperText('اولویت چینش در دسته‌بندی'),

                        Toggle::make('in_ticker')
                            ->label('نمایش در تیکر متحرک (Ticker)')
                            ->helperText('قرارگیری در نوار متحرک لوگوهای صفحه نخست')
                            ->default(false),
                    ])
                    ->columnSpan(1),
            ]);
    }
}
