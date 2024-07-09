<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Cart;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Inventory;
use App\Models\OrderItem;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Grid;

use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Column;
use Filament\Forms\Components\Select;
use Filament\Notifications\Collection;
use Filament\Pages\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\InventoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InventoryResource\RelationManagers;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             Grid::make()->schema([
    //                 TextInput::make('name'),
    //                 TextInput::make('stock')->numeric(),
    //             ]),
    //             TextInput::make('price')->numeric(),
    //             Grid::make()->schema([
    //                 Select::make('category')
    //                     ->label('Category')
    //                     ->options([
    //                         'x' => 'ss'
    //                     ]),
    //                 Select::make('supplier')
    //                     ->label('Supplier')
    //                     ->options([
    //                         'x' => 'ss'
    //                     ]),
    //             ]),
    //             FileUpload::make('image')->columnSpanFull()->directory('example'),

    //         ]);
    // }

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
                Tables\Actions\EditAction::make()
                ->color(Color::Green)
                    ->form([
                        Grid::make()->schema([
                            TextInput::make('name'),
                            TextInput::make('stock')->numeric(),
                        ]),
                        TextInput::make('price')->numeric(),
                        Grid::make()->schema([
                            Select::make('category')
                                ->label('Category')
                                ->options(function () {
                                    $options = DB::table('categories')->pluck('name', 'id')->toArray();
                                    return $options;
                                }),
                            Select::make('supplier')
                                ->label('Supplier')
                                ->options(function () {
                                    $options = DB::table('suppliers')->pluck('name', 'id')->toArray();
                                    return $options;
                                }),
                        ]),
                        FileUpload::make('image')->columnSpanFull()->directory('example')->required(),
                        RichEditor::make('description')
                    ])->action(function (array $data, $record) {

                        DB::table('inventories')->where('id', $record->id)->update([
                            'category' => $data['category'],
                            'name' => $data['name'],
                            'stock' => $data['stock'],
                            'price' => $data['price'],
                            'supplier' => $data['supplier'],
                            'image' => $data['image'],
                            'description' => $data['description'],
                        ]);
                        Notification::make()
                            ->title('Updated successfully')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\DeleteAction::make()->action(function ($record) {

                    if (!!$record->image) {
                        Storage::delete('/public/' . $record->image);
                        Inventory::where('id', $record->id)->delete();
                    } else {
                        Inventory::where('id', $record->id)->delete();
                    }
                    Cart::where('product_id',$record->id)->delete();
                    OrderItem::where('product_id',$record->id)->delete();
                    Notification::make()
                        ->title('Deleted successfully')
                        ->success()
                        ->send();
                }),


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
            'index' => Pages\ListInventories::route('/'),
            // 'create' => Pages\CreateInventory::route('/create'),
            // 'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }
}
