<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
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
                Tabs::make('ProjectTabs')
                    ->tabs([
                        // تب اول: اطلاعات متنی و کیس‌استدی
                        Tabs\Tab::make('محتوا و جزئیات')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextInput::make('title')
                                    ->label('عنوان پروژه')
                                    ->placeholder('مثلاً: سامانه مدیریت سفارشات')
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
                                    ->placeholder('project-slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(180),

                                Textarea::make('summary')
                                    ->label('خلاصه کوتاه (نمایش در کارت پروژه)')
                                    ->placeholder('یک یا دو خط معرفی شاخص...')
                                    ->required()
                                    ->rows(3)
                                    ->maxLength(250)
                                    ->columnSpanFull(),

                                RichEditor::make('description')
                                    ->label('مطالعه موردی و تشریح فنی (Case Study)')
                                    ->placeholder('توضیحات کامل پروژه...')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        // تب دوم: تصاویر و گالری
                        Tabs\Tab::make('رسانه و تصاویر')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Repeater::make('primaryImage')
                                    ->relationship('primaryImage')
                                    ->label('تصویر کاور اصلی')
                                    ->schema([
                                        FileUpload::make('file_path')
                                            ->label('فایل تصویر کاور')
                                            ->image()
                                            ->directory('projects/covers')
                                            ->imageEditor()
                                            ->maxSize(4096)
                                            ->required(),

                                        TextInput::make('alt_text')
                                            ->label('متن جایگزین (Alt)')
                                            ->maxLength(100),
                                    ])
                                    ->mutateRelationshipDataBeforeCreateUsing(function (array $data): array {
                                        $data['is_primary'] = true;
                                        return $data;
                                    })
                                    ->maxItems(1)
                                    ->deletable(true)
                                    ->reorderable(false)
                                    ->columnSpanFull(),

                                Repeater::make('media')
                                    ->relationship('media')
                                    ->label('گالری اسکرین‌شات‌ها و تصاویر تکمیلی')
                                    ->schema([
                                        FileUpload::make('file_path')
                                            ->label('تصویر اسلاید')
                                            ->image()
                                            ->directory('projects/gallery')
                                            ->imageEditor()
                                            ->maxSize(5120)
                                            ->required(),

                                        TextInput::make('alt_text')
                                            ->label('متن جایگزین (Alt)')
                                            ->placeholder('توضیح تصویر...')
                                            ->maxLength(150),
                                    ])
                                    ->columns(2)
                                    ->orderColumn('sort_order')
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['alt_text'] ?? 'تصویر گالری')
                                    ->columnSpanFull(),
                            ]),

                        // تب سوم: تنظیمات انتشار و پیوندها
                        Tabs\Tab::make('تنظیمات و پیوندها')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Select::make('skills')
                                    ->label('تکنولوژی‌ها و ابزارها')
                                    ->placeholder('انتخاب استک فنی...')
                                    ->relationship('skills', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable()
                                    ->columnSpanFull(),

                                TextInput::make('demo_url')
                                    ->label('آدرس دموی آنلاین')
                                    ->placeholder('https://...')
                                    ->url()
                                    ->suffixIcon('heroicon-m-globe-alt'),

                                TextInput::make('github_url')
                                    ->label('آدرس سورس گیت‌هاب')
                                    ->placeholder('https://github.com/...')
                                    ->url()
                                    ->suffixIcon('heroicon-m-code-bracket'),

                                TextInput::make('sort_order')
                                    ->label('ترتیب نمایش')
                                    ->numeric()
                                    ->default(0),

                                Toggle::make('is_published')
                                    ->label('وضعیت انتشار در وب‌سایت')
                                    ->default(true),

                                Toggle::make('is_featured')
                                    ->label('پروژه ویژه (Featured)')
                                    ->default(false),
                            ])
                            ->columns(3),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
