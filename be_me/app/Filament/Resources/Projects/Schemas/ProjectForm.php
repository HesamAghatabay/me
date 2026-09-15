<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        Section::make('اطلاعات اصلی و کیس‌استدی')
                            ->schema([
                                TextInput::make('title')
                                    ->label('عنوان پروژه')
                                    ->required()
                                    ->maxLength(150)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                        if (empty($get('slug')) && filled($state)) {
                                            $set('slug', Str::slug($state));
                                        }
                                    }),

                                TextInput::make('slug')
                                    ->label('اسلاگ (URL)')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(180)
                                    ->helperText('آدرس اختصاصی در مسیر /projects/{slug}'),

                                Textarea::make('short_description')
                                    ->label('توضیح کوتاه (نمایش در کارت صفحه اصلی)')
                                    ->required()
                                    ->rows(3)
                                    ->maxLength(250),

                                RichEditor::make('description')
                                    ->label('توضیحات کامل و مطالعه موردی (Case Study)')
                                    ->toolbarButtons([
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'heading',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'undo',
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(2),

                        Section::make('تنظیمات انتشار و پیوندها')
                            ->schema([
                                Toggle::make('is_featured')
                                    ->label('پروژه ویژه (Featured)')
                                    ->helperText('نمایش شاخص در صفحه اصلی')
                                    ->default(false),

                                Toggle::make('is_published')
                                    ->label('وضعیت انتشار')
                                    ->default(true),

                                TextInput::make('sort_order')
                                    ->label('ترتیب نمایش')
                                    ->numeric()
                                    ->default(0),

                                Select::make('skills')
                                    ->label('تکنولوژی‌ها و مهارت‌ها')
                                    ->relationship('skills', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable(),

                                TextInput::make('demo_url')
                                    ->label('آدرس دموی آنلاین')
                                    ->url()
                                    ->suffixIcon('heroicon-m-globe-alt'),

                                TextInput::make('github_url')
                                    ->label('آدرس ریپازیتوری (GitHub)')
                                    ->url()
                                    ->suffixIcon('heroicon-m-code-bracket'),
                            ])
                            ->columnSpan(1),
                    ]),
            ]);
    }
}
