<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class OrderOverview extends ChartWidget
{
    protected static ?string $heading = 'Total Order';
    protected static ?string $maxHeight = '250px';


    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Order created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
