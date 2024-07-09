<?php

namespace App\Filament\Employee\Resources\OrdersResource\Pages;

use App\Filament\Employee\Resources\OrdersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrders extends CreateRecord
{
    protected static string $resource = OrdersResource::class;
}
