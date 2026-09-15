<?php

namespace App\Filament\Resources\Experiences\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ExperiencesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company')
                    ->label('نام شرکت')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('role')
                    ->label('سمت شغلی')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('start_date')
                    ->label('شروع')
                    ->date()
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('پایان')
                    ->date()
                    ->placeholder('تا کنون')
                    ->sortable(),

                IconColumn::make('is_current')
                    ->label('شغل فعلی')
                    ->boolean(),

                TextColumn::make('sort_order')
                    ->label('ترتیب')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
            ->filters([
                Filter::make('is_current')
                    ->label('فقط موقعیت‌های شغلی فعلی')
                    ->query(fn (Builder $query): Builder => $query->where('is_current', true)),

                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
