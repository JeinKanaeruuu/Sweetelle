<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CashierHistoryResource\Pages;
use App\Filament\Resources\CashierHistoryResource\RelationManagers;
use App\Models\CashierHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CashierHistoryResource extends Resource
{
    protected static ?string $model = CashierHistory::class;
    protected static ?string $navigationGroup = 'Payment & History';

    protected static ?string $navigationIcon = 'heroicon-c-archive-box-arrow-down';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction_id')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('customer_name')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('transaction_time')
                ->searchable()
                ->sortable(),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCashierHistories::route('/'),
            'create' => Pages\CreateCashierHistory::route('/create'),
            
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
