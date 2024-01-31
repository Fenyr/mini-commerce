<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderItemRelationManager extends RelationManager
{
    protected static string $relationship = 'order_item';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                    Forms\Components\Select::make('order_id')->options(Order::pluck('id',"id"))
                    ->required(),
                    Forms\Components\Select::make('product_id')->options(Product::pluck('title',"id"))
                    ->required(),
                    Forms\Components\TextInput::make('quantity')->numeric()->afterStateUpdated(fn (Set $set, ?string $state) => $set('subtotal', $state))->live()
                        ->required(),
                    Forms\Components\TextInput::make('subtotal')->default(0)->numeric()->prefix("Rp. ")->disabled()->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Ordered Item')
            ->columns([
                Tables\Columns\ImageColumn::make('product.image')->label('Image'),
                Tables\Columns\TextColumn::make('product.title')->label('Title'),
                Tables\Columns\TextColumn::make('product.price')->prefix("Rp. ")->label('Price'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('subtotal')->prefix('Rp.'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
