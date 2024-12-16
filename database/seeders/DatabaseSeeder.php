<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $faker = Faker::create();
        $priceValues = [499000, 420000, 375000, 300000, 475000, 400000, 1110000, 499999];
         foreach (range(1, 20) as $index){
             $user = User::inRandomOrder()->first(); // Lấy user_id ngẫu nhiên từ bảng users
             $price = $faker->randomElement($priceValues);
             Order::create([
                 'order_id' => $faker->unique()->randomNumber(9),
                 'user_id' => $user->user_id, // Lấy user_id ngẫu nhiên từ bảng users
                 'total_price' => $price,
                 'final_price' => $price,
                 'status' => $faker->randomElement(['Đã nhận được hàng', 'Đã xác nhận', 'Đang sử lý']),
                 'payment_method' => $faker->randomElement(['Tiền mặt khi giao hàng', 'VNPay']),
                 'payment_status' => $faker->randomElement(['Đã thanh toán']),
                 //'created_at' => time(),
                 'created_at' => $faker->dateTimeBetween('13-12-2024', '14-12-2024'),
                 'updated_at' => now(),
             ]);
         }

    }
}