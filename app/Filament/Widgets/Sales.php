<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Orders;
use Filament\Widgets\ChartWidget;

class Sales extends ChartWidget
{
    protected static ?string $heading = 'SALES';
    public ?string $filter = 'month';
    protected static ?string $pollingInterval = null;


    protected function getData(): array
    {

        if ($this->filter == 'month') {
            $monthlySales = Orders::selectRaw('MONTH(created_at) as month, SUM(price) as total_sales')
                ->where('status', 'delivered')
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $monthlySalesData = [];

            // Populate the array with sales data for each month
            for ($i = 1; $i <= 12; $i++) {

                $sales = $monthlySales->where('month', $i)->first();
                $monthName = date('F', mktime(0, 0, 0, $i, 1));
                $monthlySalesData[$monthName] = $sales ? $sales->total_sales : 0;
            }

            // Define month labels
            // $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            return [
                'datasets' => [
                    [
                        'label' => 'MONTH SALES',
                        'data' => $monthlySalesData,
                    ],
                ],
                // 'labels' => $labels,
            ];
        } elseif ($this->filter == 'week') {

            $sort =  function($a, $b) {
                // Define the order of the months
                $monthsOrder = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

                // Extract the month and week number
                list($monthA, , $weekA) = explode(' ', $a);
                list($monthB, , $weekB) = explode(' ', $b);

                // Get the month position
                $monthPosA = array_search($monthA, $monthsOrder);
                $monthPosB = array_search($monthB, $monthsOrder);

                // Compare months first
                if ($monthPosA != $monthPosB) {
                    return $monthPosA - $monthPosB;
                }

                // If months are the same, compare weeks
                return (int)$weekA - (int)$weekB;
            };
            $weeklySales = Orders::selectRaw('WEEK(created_at) as week, SUM(price) as total_sales')
            ->where('status', 'delivered')
                ->groupBy('week')

                ->orderBy('week')

                ->get();

            $weeklySalesData = [];

            foreach ($weeklySales as $sale) {

                $weekNumber = str_pad($sale->week, 2, '0', STR_PAD_LEFT);
                $week = Carbon::now()->startOfYear()->addWeeks($sale->week - 1);
                $key = $week->format('M') . ' Week ' . $weekNumber;
                $weeklySalesData[$key] = $sale->total_sales;
            }

            $currentWeek = now()->weekOfYear;
            $labels = [];
            for ($i = 1; $i <= $currentWeek; $i++) {

                $week = now()->startOfYear()->addWeeks($i - 1);

                // $labels[] = $week->format('M') . ' Week ' . $week->weekOfYear;

                // Retrieve sales data for the current week

                if (!isset($weeklySalesData[$week->format('M') . ' Week ' . $week->weekOfYear])) {

                    $weeklySalesData[$week->format('M') . ' Week ' . $week->weekOfYear] = 0;

                }

            }
            uksort($weeklySalesData,$sort);


            return [

                'datasets' => [

                    [

                        'label' => 'WEEKLY SALES',

                        'data' => $weeklySalesData,

                    ],



                ],


            ];
        }elseif($this->filter == 'day')
        {
            $dailySales = Orders::selectRaw('DATE(created_at) as date, SUM(price) as total_sales')
            ->where('status', 'delivered')
            ->groupBy('date')
            ->orderBy('date')
            ->get();


        $dailySalesData = [];

        // Populate the dailySalesData array
        foreach ($dailySales as $sale) {
            $date = Carbon::parse($sale->date);
            $key = $date->format('M j'); // Format the date as "Jan 1", "Jan 2", etc.

            $dailySalesData[$key] = $sale->total_sales;
        }

        // Fill in missing dates with zero sales
        $startDate = Carbon::now()->startOfYear();
        $endDate = Carbon::now();
        $currentDate = $startDate->copy();

        while ($currentDate->lte($endDate)) {
            $key = $currentDate->format('M j');

            if (!isset($dailySalesData[$key])) {
                $dailySalesData[$key] = 0;
            }
            $currentDate->addDay();
        }

        // Define the sorting function
        $sort = function($a, $b) {
            $dateA = Carbon::createFromFormat('M j', $a);
            $dateB = Carbon::createFromFormat('M j', $b);
            return $dateA->timestamp - $dateB->timestamp;
        };

        // Sort the dailySalesData array
        uksort($dailySalesData, $sort);

        return [
            'datasets' => [
                [
                    'label' => 'DAILY SALES',
                    'data' => $dailySalesData,
                ],
            ],
        ];
        }
    }
    protected function getFilters(): ?array
    {
        return [
            'day' => 'Daily',
            'week' => 'week',
            'month' => ' Month',

        ];
    }
    protected function getType(): string
    {
        return 'line';
    }
}
