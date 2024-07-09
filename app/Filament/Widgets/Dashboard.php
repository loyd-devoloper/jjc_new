<?php

namespace App\Filament\Widgets;

use App\Models\Orders;
use App\Models\Supplier;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class Dashboard extends BaseWidget
{
    protected function getStats(): array
    {
        $monthlySales = Orders::selectRaw('MONTH(created_at) as month, SUM(price) as total_sales')
        ->groupBy('month')
        ->orderBy('month')
        ->get();
        $total = 0;

        // Populate the array with sales data for each month
        for ($i = 1; $i <= 12; $i++) {

            $sales = $monthlySales->where('month', $i)->first();
            $monthName = date('F', mktime(0, 0, 0, $i, 1));
            $total = $sales ? $total += $sales->total_sales : $total += 0;
        }

        $supplier = Supplier::count();

        $orders = Orders::count();
        return [
            Stat::make('Sales', 'PHP '.number_format($total,2))->icon('heroicon-o-presentation-chart-line'),
            Stat::make('Orders', $orders)->icon('heroicon-o-truck'),
            Stat::make('Suppliers', $supplier)->icon('heroicon-o-users'),
        ];
    }
}
