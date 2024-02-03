<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Foundation\Auth\User;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Resource Management';


    public static function form(Form $form): Form
    {
        $price = OrderItem::join('products', 'order_items.product_id', '=', 'products.id')
            ->where('order_items.order_id', 1)
            ->sum('products.price');
        return $form
            ->schema([
                Grid::make(3)->schema([
                    Forms\Components\Select::make('user_id')->options(User::pluck("name", "id"))->default("user_id")->required(),
                    Forms\Components\TextInput::make('total')
                        ->prefix("Rp.")->required(),
                    Forms\Components\Select::make('status')->options([
                        'unpaid' => "Unpaid",
                        'process' => "Process",
                        'delivered' => "Delivered"

                    ])
                ]),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_item.product.title')->label("Product")->listWithLineBreaks()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_item.subtotal')->label("Price")->listWithLineBreaks()->prefix('Rp. ')
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_item.quantity')->label("Quantity")->listWithLineBreaks()->suffix(' pcs')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')->colors([
                    'warning' => 'process',
                    'success' => 'delivered',
                    'danger' => 'unpaid',
                ])
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\OrderItemRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
