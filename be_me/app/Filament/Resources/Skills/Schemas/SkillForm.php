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
            ->components([
                Section::make('مشخصات مهارت')
                    ->schema([
                        TextInput::make('name')
                            ->label('نام تکنولوژی / مهارت')
                            ->required()
                            ->maxLength(80),

                        Select::make('category')
                            ->label('دسته‌بندی')
                            ->options([
                                'Frontend' => 'فرانت‌اند (Frontend)',
                                'Backend' => 'بک‌اند (Backend)',
                                'DevOps' => 'دواپس و سرور (DevOps)',
                                'Database' => 'دیتابیس (Database)',
                                'Tools' => 'ابزارها و فریم‌ورک‌ها (Tools)',
                            ])
                            ->required()
                            ->native(false),

                        Toggle::make('in_ticker')
                            ->label('نمایش در نوار متحرک لوگوها (Ticker)')
                            ->default(false),

                        TextInput::make('sort_order')
                            ->label('ترتیب نمایش')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
            ]);
    }
}
