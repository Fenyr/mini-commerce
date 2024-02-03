<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;

class ProductOverview extends ChartWidget
{
    protected static ?string $heading = 'Product Category';
    protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {
        return [

            'datasets' => [[
                'label' => 'My First Dataset',
                'data' => [
                    Product::where('category_id', 1)->count(),
                    Product::where('category_id', 2)->count(),
                    Product::where('category_id', 3)->count(),
                    Product::where('category_id', 4)->count(),
                    Product::where('category_id', 5)->count()
                ],
                'backgroundColor' => [
                    'rgba(255, 99, 132)',
                    'rgba(255, 159, 64)',
                    'rgba(255, 205, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                ],
                'hoverOffset' => 4
            ]],

            'labels' => ['Bread', 'Cake', 'Cookies', 'Pasta', 'Drink'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
