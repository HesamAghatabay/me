<?php

namespace App\Filament\Resources\Skills\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class SkillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('نام مهارت')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category')
                    ->label('دسته‌بندی')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Frontend' => 'info',
                        'Backend' => 'success',
                        'DevOps' => 'warning',
                        'Database' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                ToggleColumn::make('in_ticker')
                    ->label('نوار متحرک'),

                TextColumn::make('sort_order')
                    ->label('ترتیب')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('تاریخ ثبت')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
            ->filters([
                SelectFilter::make('category')
                    ->label('دسته‌بندی')
                    ->options([
                        'Frontend' => 'Frontend',
                        'Backend' => 'Backend',
                        'DevOps' => 'DevOps',
                        'Database' => 'Database',
                        'Tools' => 'Tools',
                    ]),
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
