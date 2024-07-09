<?php

namespace App\Filament\Employee\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Inventory;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Employee\Resources\InventoryResource\Pages;
use App\Filament\Employee\Resources\InventoryResource\RelationManagers;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            TextColumn::make('id'),
            ImageColumn::make('image')
                ->state(function ($record) {
                    return $record->image;
                })
                ->extraImgAttributes([
                    'img' => 'src'
                ]),
            TextColumn::make('category')
                ->state(function ($record) {
                    $name = DB::table('categories')->where('id', $record->category)->pluck('name');
                    return $name;
                }),
            TextColumn::make('name')->searchable(),
            TextColumn::make('stock'),
            TextColumn::make('price'),
            TextColumn::make('supplier')->state(
                function ($record) {
                    $name = DB::table('suppliers')->where('id', $record->supplier)->pluck('name');
                    return $name;
                }
            ),

        ])
        ->filters([
            //
        ])
        ->actions([



        ])
        ->bulkActions([

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
            'index' => Pages\ListInventories::route('/'),
            'create' => Pages\CreateInventory::route('/create'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }
}
