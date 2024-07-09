<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CategoryResource;
use Filament\Support\Enums\MaxWidth;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('New Category')
            ->form([

                    TextInput::make('name'),


            ])->action(function (array $data) {

                DB::table('categories')->insert([

                    'name' => $data['name'],

                ]);
                Notification::make()
                ->title('Saved successfully')
                ->success()
                ->send();
            })->modalWidth(MaxWidth::Medium)
        ];
    }
}
