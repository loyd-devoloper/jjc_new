<?php

namespace App\Filament\Resources\InventoryResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\InventoryResource;
use Filament\Notifications\Notification;
class CreateInventory extends CreateRecord
{
    protected static string $resource = InventoryResource::class;
    protected function handleRecordCreation(array $data): Model
        {
           DB::table('inventories')->insert([
                'category'=>'1',
                'name'=>$data['name'],
                'stock'=>$data['stock'],
                'price'=>$data['name'],
                'supplier'=>'1',
           ]);
            return static::getModel()::create($data);

        }


        protected function getCreatedNotification(): ?Notification
        {
            return Notification::make()
                ->success()
                ->title('User registered')
                ->body('The user has been created successfully.');
        }
}
