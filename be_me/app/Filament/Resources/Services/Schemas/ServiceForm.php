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
            ->components([
                Section::make('مشخصات و شرح خدمت')
                    ->schema([
                        TextInput::make('title')
                            ->label('عنوان خدمت')
                            ->placeholder('مثلاً: طراحی و توسعه وب‌اپلیکیشن')
                            ->required()
                            ->maxLength(120),

                        TextInput::make('sort_order')
                            ->label('ترتیب نمایش')
                            ->numeric()
                            ->default(0),

                        Textarea::make('description')
                            ->label('توضیحات و ارزش‌آفرینی')
                            ->placeholder('شرح مختصر درباره نوع خدمتی که به کارفرما یا مشتری ارائه می‌دهید...')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
