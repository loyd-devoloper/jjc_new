<?php

namespace App\Filament\Resources\SupplierResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SupplierResource;
use App\Filament\Resources\SupplierResource\Widgets\CustomerOverview;

class ListSuppliers extends ListRecords
{
    protected static string $resource = SupplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('New Supplier')
            ->form([

                    TextInput::make('name')->required(),
                    TextInput::make('contact')->required(),
                    TextInput::make('address')->required(),


            ])->action(function (array $data) {

                DB::table('suppliers')->insert([

                    'name' => $data['name'],
                    'contact' => $data['contact'],
                    'address' => $data['address'],

                ]);
                Notification::make()
                ->title('Saved successfully')
                ->success()
                ->send();
            })->modalWidth(MaxWidth::Medium)
        ];
    }
    // protected function getHeaderWidgets(): array {
    //     return [
    //         CustomerOverview::class,
    //     ];
    // }
}
