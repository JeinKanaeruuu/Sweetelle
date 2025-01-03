<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';
    protected static ?string $navigationGroup = 'Pendapatan & Transaksi';
    protected static ?string $navigationLabel = 'Transaksi';
    protected static ?string $pluralLabel = 'Transaksi';
    protected static ?string $label = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->label('Status Transaksi')
                    ->options([
                        'Diproses' => 'Diproses',
                        'Dikirim' => 'Dikirim',
                        'Diterima' => 'Diterima',
                        'Dibatalkan' => 'Dibatalkan',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('Nomor Handphone')
                    ->maxLength(15)
                    ->tel(),
                Forms\Components\Textarea::make('shipping_address')
                    ->label('Alamat Pengiriman')
                    ->maxLength(255)
                    ->rows(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Transaksi #')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pelanggan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('items')
                    ->label('Detail Produk')
                    ->formatStateUsing(function ($record) {
                        return $record->items->map(function ($item) {
                            return "{$item->product->name} ({$item->quantity} pcs)";
                        })->join(', ');
                    }),
                Tables\Columns\TextColumn::make('shipping_address')
                    ->label('Alamat Pengiriman')
                    ->formatStateUsing(fn($state) => Str::limit($state, 20))
                    ->tooltip(fn($record) => $record->shipping_address),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total (IDR)')
                    ->money('idr', true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->formatStateUsing(fn($state) => ucfirst($state))
                    ->color(fn($record) => match ($record->status) {
                        'Diproses' => 'warning',
                        'Dikirim' => 'info',
                        'Diterima' => 'success',
                        'Dibatalkan' => 'danger',
                        default => 'default',
                    }),
                Tables\Columns\TextColumn::make('payment_proof')
                    ->label('Bukti Pembayaran')
                    ->formatStateUsing(fn($state) => $state
                        ? '<a href="' . asset('storage/' . $state) . '" target="_blank">Lihat Bukti</a>'
                        : 'Tidak ada bukti')
                    ->html(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pemesanan')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('date')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('until')->label('Sampai Tanggal'),
                    ])
                    ->query(fn(Builder $query, array $data) => $query
                        ->when($data['from'], fn($q) => $q->whereDate('created_at', '>=', $data['from']))
                        ->when($data['until'], fn($q) => $q->whereDate('created_at', '<=', $data['until']))),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'Diproses' => 'Diproses',
                        'Dikirim' => 'Dikirim',
                        'Diterima' => 'Diterima',
                        'Dibatalkan' => 'Dibatalkan',
                    ]),
            ]);
    }
    

    public static function getRelations(): array
    {
        return [
            // Tambahkan relasi jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'Diproses')->count();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
