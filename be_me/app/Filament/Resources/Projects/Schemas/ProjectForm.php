<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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
            ->columns(3)
            ->components([
                // ستون اصلی: مشخصات و محتوای پروژه
                Section::make('مشخصات و محتوای پروژه')
                    ->description('عنوان، پیوند یکتا و توضیحات پروژه')
                    ->schema([
                        TextInput::make('title')
                            ->label('عنوان پروژه')
                            ->placeholder('مثلاً: سامانه مدیریت هوشمند پورتفولیو')
                            ->required()
                            ->maxLength(150)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                if (empty($get('slug')) && filled($state)) {
                                    $set('slug', Str::slug($state, '-', null));
                                }
                            }),

                        TextInput::make('slug')
                            ->label('اسلاگ (URL)')
                            ->placeholder('smart-portfolio')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(160),

                        Textarea::make('summary')
                            ->label('خلاصه کوتاه')
                            ->placeholder('یک یا دو خط توضیح شاخص پروژه برای کارت‌ها...')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),

                        RichEditor::make('description')
                            ->label('مطالعه موردی و تشریح فنی (Case Study)')
                            ->placeholder('توضیحات کامل، چالش‌های فنی و دستاوردها...')
                            ->default('')
                            ->formatStateUsing(function ($record, $state): string {
                                if ($record) {
                                    $val = $record->getTranslation('description', 'fa', false);
                                    return is_string($val) ? $val : '';
                                }

                                return is_string($state) ? $state : '';
                            })
                            ->dehydrateStateUsing(fn($state): string => is_string($state) ? $state : '')
                            ->columnSpanFull(),

                        Repeater::make('media')
                            ->relationship('media')
                            ->label('تصاویر و گالری پروژه')
                            ->schema([
                                FileUpload::make('file_path')
                                    ->label('فایل تصویر')
                                    ->image()
                                    ->directory('projects')
                                    ->imageEditor()
                                    ->maxSize(5120)
                                    ->required(),

                                TextInput::make('alt_text')
                                    ->label('متن جایگزین (Alt)')
                                    ->placeholder('توضیح تصویر...')
                                    ->maxLength(150),

                                Toggle::make('is_primary')
                                    ->label('تصویر کاور اصلی')
                                    ->default(false),
                            ])
                            ->columns(3)
                            ->orderColumn('sort_order')
                            ->collapsible()
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                // ستون کناری: تنظیمات و انتشار
                Section::make('تنظیمات و انتشار')
                    ->description('وضعیت نمایش، مهارت‌ها و لینک‌های خارجی')
                    ->schema([
                        Select::make('skills')
                            ->label('تکنولوژی‌ها و ابزارها')
                            ->placeholder('انتخاب مهارت‌ها...')
                            ->relationship('skills', 'name')
                            ->getOptionLabelFromRecordUsing(fn($record) => $record->getTranslation('name', 'fa', false) ?? $record->name)
                            ->multiple()
                            ->preload()
                            ->searchable(),

                        TextInput::make('demo_url')
                            ->label('آدرس دموی آنلاین')
                            ->placeholder('https://...')
                            ->url()
                            ->suffixIcon('heroicon-m-globe-alt'),

                        TextInput::make('github_url')
                            ->label('آدرس مخزن گیت‌هاب')
                            ->placeholder('https://github.com/...')
                            ->url()
                            ->suffixIcon('heroicon-m-code-bracket'),

                        TextInput::make('sort_order')
                            ->label('ترتیب نمایش')
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_published')
                            ->label('وضعیت انتشار')
                            ->default(true),

                        Toggle::make('is_featured')
                            ->label('پروژه ویژه (Featured)')
                            ->default(false),
                    ])
                    ->columnSpan(1),
            ]);
    }
}
