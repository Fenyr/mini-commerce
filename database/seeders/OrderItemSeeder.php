<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderItem::insert([
            ["order_id" => 1, "product_id" => 1, "quantity" => 1, "subtotal" => 10000],
            ["order_id" => 1, "product_id" => 2, "quantity" => 1, "subtotal" => 10000],
            ["order_id" => 2, "product_id" => 3, "quantity" => 1, "subtotal" => 10000],
        ]);
    }
}
