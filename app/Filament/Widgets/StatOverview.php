<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $stock = Product::where('stock', '<=', 0)->count();
        return [
            Stat::make('Total User', User::where('role', 'user')->count())->description('created')->color('info'),
            Stat::make('Product', Product::count())->description('Added')->color('success'),
            Stat::make('Total Order', Order::count())->description('Made')->color('secondary'),
            Stat::make('Out Of Stock', $stock)->description('no need Restock')->color($stock == 0 ? "success" : "danger"),
        ];
    }
}
