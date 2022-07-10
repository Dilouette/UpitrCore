<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::factory()
        ->count(50)
        ->create([
            'user_id' => 1,
            'candidate_id' => 1,
        ]);

        Message::factory()
        ->count(50)
        ->create();

        $messages = Message::all();
        foreach ($messages as $key => $msg) {
            Message::factory()
            ->count(2)
            ->create([
                'reply_to' => $msg->id,
                'opened' => $msg->opened
            ]);
        }
    }
}
