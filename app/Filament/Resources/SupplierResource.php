<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Supplier;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Actions\Action;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\KeyValueEntry;
use App\Filament\Resources\SupplierResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SupplierResource\RelationManagers;
use App\Filament\Resources\SupplierResource\Widgets\CustomerOverview;
use App\Models\Inventory;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

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
                TextColumn::make('name'),
                TextColumn::make('contact'),
                TextColumn::make('address'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->color(Color::Green)
                    ->form([

                        TextInput::make('name')->required(),
                        TextInput::make('contact')->required(),
                        TextInput::make('address')->required(),


                    ])->action(function (array $data, $record) {

                        DB::table('suppliers')->where('id', $record->id)->update([

                            'name' => $data['name'],
                            'contact' => $data['contact'],
                            'address' => $data['address'],

                        ]);
                        Notification::make()
                            ->title('Saved successfully')
                            ->success()
                            ->send();
                    })->modalWidth(MaxWidth::Medium),
                Tables\Actions\ViewAction::make()
                    ->label('View Product')
                    ->action(fn ($record) => dd($record))
                    ->modalContent(function($record)
                    {
                        $inventories = Inventory::where('supplier',$record->id)->get();
                        return view('filament.pages.supplier-table',['records'=>$inventories]);
                    }
                    )->color(Color::Blue),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListSuppliers::route('/'),
            'sort' => Pages\SortUsers::route('/sort/{record}'),
        ];
    }

}
