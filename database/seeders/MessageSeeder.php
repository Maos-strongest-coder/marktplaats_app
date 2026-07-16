<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\User;
use App\Models\Advertisement;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $advertisements = Advertisement::all();

        for ($i = 0; $i < 100; $i++) {
            
            $advertisement = $advertisements->random();

            $seller_id = $advertisement->user_id;

            $buyer_id = $users->where('id', '!=', $seller_id)->random()->id;

            $isSenderBuyer = fake()->boolean();

            $sender_id = $isSenderBuyer ? $buyer_id : $seller_id;
            $receiver_id = $isSenderBuyer ? $seller_id : $buyer_id;


            Message::factory()->create([
                'advertisement_id' => $advertisement->id,
                'sender_id' => $sender_id,
                'receiver_id' => $receiver_id,
            ]);
        }
    }
}
