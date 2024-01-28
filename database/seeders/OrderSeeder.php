<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::insert([
            ["user_id" =>2, "total" => 20000, "status"=>'process'],
            ["user_id" =>3, "total" => 10000, "status"=>'process'],
        ]);
    }
}
