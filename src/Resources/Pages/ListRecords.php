<?php

namespace FF\FilamentTools\Resources\Pages;

use Filament\Resources\Pages\ListRecords as FilamentListRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;

abstract class ListRecords extends FilamentListRecords
{
    protected function getStandardTable(Table $table): Table {
        return $table
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->modal()
                    ->color('gray')
                    ->tooltip('編輯'),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->color('gray')
                    ->tooltip('刪除'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->paginated([30, 60, 90])
            ->defaultPaginationPageOption(30);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
