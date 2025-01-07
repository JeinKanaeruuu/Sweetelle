<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\NumberInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;;




class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationGroup = 'Produk';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Produk';
    protected static ?string $pluralLabel = 'Produk';
    protected static ?string $label = 'Produk';

    // app/Filament/Resources/ProductResource.php
public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
                Forms\Components\Select::make('category')
                    
                    ->options([
                        'kue-satuan' => 'Kue Satuan',
                        'snack-box' => 'Snack Box',
                        'kue-nampan' => 'Kue Nampan',
                        'kue-tampah-bambu' => 'Kue Tampah Bambu',
                        'jajan-pasar' => 'Jajan Pasar',
                        'bubur-traditional' => 'Bubur Traditional',
                        'tampah-rujak-buah' => 'Tampah Rujak Buah',
                        'tampah-rebusan' => 'Tampah Rebusan',
                        'tumpeng-tower-kue' => 'Tumpeng Tower Kue',
                        'bolu-cake' => 'Bolu / Cake',
                        'kue-kering' => 'Kue Kering / Kletikan',
                        'hantaran-kue' => 'Hantaran Kue',
                        'hantaran-pernikahan' => 'Hantaran Pernikahan',
                    ])
                    ->required(),
            Forms\Components\FileUpload::make('image')
                ->required()
                ->image()
                ->disk('public')
                ->columnSpanFull(),
            Forms\Components\Textarea::make('description')
                ->required(),
            Forms\Components\TextInput::make('stock')
                ->required()
                ->numeric(),
            Forms\Components\TextInput::make('price')
                ->required()
                ->numeric(),
            // Forms\Components\TextInput::make('discount_percentage') // Tambahkan diskon
            //     ->label('Persentase Diskon (%)')
            //     ->numeric()
            //     ->default(0), // default 0
            // Forms\Components\DatePicker::make('start_date')
            //     ->label('Tanggal Mulai Diskon')
            //     ->nullable(),
            // Forms\Components\DatePicker::make('end_date')
            //     ->label('Tanggal Berakhir Diskon')
            //     ->nullable(),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('category')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'kue-satuan' => 'Kue Satuan',
                        'snack-box' => 'Snack Box',
                        'kue-nampan' => 'Kue Nampan',
                        'kue-tampah-bambu' => 'Kue Tampah Bambu',
                        'jajan-pasar' => 'Jajan Pasar',
                        'bubur-traditional' => 'Bubur Traditional',
                        'tampah-rujak-buah' => 'Tampah Rujak Buah',
                        'tampah-rebusan' => 'Tampah Rebusan',
                        'tumpeng-tower-kue' => 'Tumpeng Tower Kue',
                        'bolu-cake' => 'Bolu / Cake',
                        'kue-kering' => 'Kue Kering / Kletikan',
                        'hantaran-kue' => 'Hantaran Kue',
                        'hantaran-pernikahan' => 'Hantaran Pernikahan',
                        default => Str::title(str_replace('-', ' ', $state)), // Default case
                    }),
                    Tables\Columns\ImageColumn::make('image')
                    ->height(50),
                    Tables\Columns\TextColumn::make('price')
                    ->money('idr', true)
                    ->sortable(),
                    // Tables\Columns\TextColumn::make('discount_percentage')
                    // ->sortable(),
                    Tables\Columns\TextColumn::make('stock')
                    ->sortable(),
                    Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }


    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    
}
