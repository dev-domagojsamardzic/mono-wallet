<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Promotion;
use App\Models\User;

class PromotionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 20 promotions and append random users
        // Do not exceed quota number
        Promotion::factory()
                    ->count(20)
                    ->create()
                    ->each(function(Promotion $promotion) {
                        // Randomly select users to attach to promotion
                        // Limit results in range from 1 to $promotion->quota
                        $users = User::inRandomOrder()->limit(random_int(1, $promotion->quota))->pluck('id')->toArray();
                        // Attach users to promotion
                        $promotion->users()->attach($users, [ 'created_at' => now(), 'updated_at' => now() ]);
                    });
    }
}
