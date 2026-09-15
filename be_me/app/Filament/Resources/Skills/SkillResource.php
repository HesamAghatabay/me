<?php

namespace App\Filament\Resources\Skills;

use App\Filament\Resources\Skills\Pages\CreateSkill;
use App\Filament\Resources\Skills\Pages\EditSkill;
use App\Filament\Resources\Skills\Pages\ListSkills;
use App\Filament\Resources\Skills\Pages\ViewSkill;
use App\Filament\Resources\Skills\Schemas\SkillForm;
use App\Filament\Resources\Skills\Schemas\SkillInfolist;
use App\Filament\Resources\Skills\Tables\SkillsTable;
use App\Models\Skill;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModelLabel(): string
    {
        return 'مهارت';
    }

    public static function getPluralModelLabel(): string
    {
        return 'مهارت‌ها و ابزارها';
    }

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return 'محتوای پورتفولیو';
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return SkillForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SkillInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SkillsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSkills::route('/'),
            'create' => CreateSkill::route('/create'),
            'view' => ViewSkill::route('/{record}'),
            'edit' => EditSkill::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
