<?php

namespace FF\FilamentTools\Resources\Tables;

use Filament\Tables\Table;
use Filament\Actions;

class TableUtils
{
    static function getStandardTable(Table $table): Table {
        return $table
            ->actions([
                Actions\EditAction::make()
                    ->label('')
                    ->modal()
                    ->color('gray')
                    ->tooltip('編輯'),
                Actions\DeleteAction::make()
                    ->label('')
                    ->color('gray')
                    ->tooltip('刪除'),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->paginated([30, 60, 90])
            ->defaultPaginationPageOption(30);
    }
}