<?php

namespace App\Filament\Employee\Resources\InventoryResource\Pages;

use App\Filament\Employee\Resources\InventoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInventory extends CreateRecord
{
    protected static string $resource = InventoryResource::class;
}
