<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Inventory;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;


class Example extends Component implements HasTable,HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;
    public $x;

    public function table(Table $table): Table
    {
        return $table
            ->query(Inventory::query()->where('supplier',$this->x))
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('category'),
                TextColumn::make('stock'),
                TextColumn::make('price'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }
    public function render()
    {
        return view('livewire.example');
    }
}
