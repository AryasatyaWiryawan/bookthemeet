<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\MeetingRequest;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Room::factory(5)->create();
        \App\Models\MeetingRequest::factory(20)->create();

        \App\Models\User::factory()->create([
            'name'     => 'Test User',
            'email'    => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
    }

}
