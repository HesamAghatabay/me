<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        Section::make('شناسنامه پروژه')
                            ->schema([
                                TextEntry::make('title')
                                    ->label('عنوان'),

                                TextEntry::make('slug')
                                    ->label('اسلاگ (URL)'),

                                TextEntry::make('skills.name')
                                    ->label('استک تکنولوژی')
                                    ->badge()
                                    ->color('primary'),

                                TextEntry::make('short_description')
                                    ->label('توضیح کوتاه')
                                    ->columnSpanFull(),

                                TextEntry::make('description')
                                    ->label('شرح مطالعه موردی')
                                    ->html()
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(2),

                        Section::make('پیوندها و وضعیت')
                            ->schema([
                                IconEntry::make('is_featured')
                                    ->label('پروژه ویژه')
                                    ->boolean(),

                                IconEntry::make('is_published')
                                    ->label('منتشر شده')
                                    ->boolean(),

                                TextEntry::make('demo_url')
                                    ->label('آدرس دمو')
                                    ->url(fn ($record) => $record->demo_url)
                                    ->openUrlInNewTab(),

                                TextEntry::make('github_url')
                                    ->label('مخزن گیت‌هاب')
                                    ->url(fn ($record) => $record->github_url)
                                    ->openUrlInNewTab(),

                                TextEntry::make('sort_order')
                                    ->label('ترتیب نمایش'),
                            ])
                            ->columnSpan(1),
                    ]),
            ]);
    }
}
