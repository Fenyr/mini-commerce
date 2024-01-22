<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\Layout\Split as FilamentSplit;
use Filament\Support\Enums\FontWeight;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make("title")->required(),
                TextInput::make("slug")->required(),
                FileUpload::make('image')->required(),
                TextInput::make('description')->required(),
                TextInput::make('price')->numeric()->inputMode('decimal')->required(),
                TextInput::make('stock')->numeric()->required(),
                TextInput::make('preorder')->numeric()->required(),
                BelongsToSelect::make('category_id')
    ->relationship('category', 'name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
                ImageColumn::make('image'),
                    TextColumn::make('title')->weight(FontWeight::Bold),
                    TextColumn::make('description'),
                TextColumn::make('price'),
                TextColumn::make('category.name'),
                TextColumn::make('preorder'),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
