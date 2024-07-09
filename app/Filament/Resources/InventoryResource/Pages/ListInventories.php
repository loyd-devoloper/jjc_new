<?php

namespace App\Filament\Resources\InventoryResource\Pages;

use Filament\Actions;
use App\Models\Category;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\InventoryResource;

class ListInventories extends ListRecords
{
    protected static string $resource = InventoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('New Inventory')
                ->form([
                    Grid::make()->schema([
                        TextInput::make('name'),
                        TextInput::make('stock')->numeric(),
                    ]),
                    TextInput::make('price')->numeric(),
                    Grid::make()->schema([
                        Select::make('category')
                            ->label('Category')
                            ->options(function()
                        {
                            $options = DB::table('categories')->pluck('name','id')->toArray();
                            return $options;
                        }),
                        Select::make('supplier')
                            ->label('Supplier')
                            ->options(function()
                            {
                                $options = DB::table('suppliers')->pluck('name','id')->toArray();
                                return $options;
                            }),
                    ]),
                    FileUpload::make('image')->columnSpanFull()->directory('example')->required(),
                    RichEditor::make('description')


                ])->action(function (array $data) {

                    DB::table('inventories')->insert([
                        'category' => '1',
                        'name' => $data['name'],
                        'stock' => $data['stock'],
                        'price' => $data['price'],
                        'supplier' => '1',
                        'image'=>$data['image'],
                        'description'=>$data['description']
                    ]);
                    Notification::make()
                    ->title('Saved successfully')
                    ->success()
                    ->send();
                })
        ];
    }
}
