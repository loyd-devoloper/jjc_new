<?php

namespace App\Filament\Resources\SupplierResource\Pages;

use Filament\Resources\Pages\Page;
use App\Filament\Resources\SupplierResource;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use App\Filament\Resources\SupplierResource\Widgets\CustomerOverview;

class SortUsers extends Page
{

    use InteractsWithPageTable;
    use InteractsWithRecord;
    public $id;
    protected static string $resource = SupplierResource::class;

    protected static string $view = 'filament.resources.supplier-resource.pages.sort-users';



    // public function mount(int | string $record): void
    // {
    //    $this->id = $record;
    //     $this->record = $this->resolveRecord($record);

    // }
}
