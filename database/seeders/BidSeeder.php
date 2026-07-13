<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bid;
use App\Models\User;
use App\Models\Advertisement;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $advertisements = Advertisement::all();
        
        Bid::factory()->count(10)->recycle($users)->recycle($advertisements)->create();
    }
}
