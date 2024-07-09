<?php

namespace App\Filament\Employee\Resources\OrdersResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Employee\Resources\OrdersResource;

class ListOrders extends ListRecords
{
    protected static string $resource = OrdersResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }

    public function getTabs(): array
    {
        return [
            'all'=>Tab::make(),
            'Processing'=>Tab::make()->modifyQueryUsing(function($query){
                $query->where('status','processing');
            }),
            'Shipped'=>Tab::make()->modifyQueryUsing(function($query){
                $query->where('status','shipped');
            }),
            'Delivered'=>Tab::make()->modifyQueryUsing(function($query){
                $query->where('status','delivered');
            }),
            'Cancelled'=>Tab::make()->modifyQueryUsing(function($query){
                $query->where('status','cancelled');
            }),
        ];
    }
}
