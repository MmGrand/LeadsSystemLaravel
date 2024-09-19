<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Status;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('12345678')
        ]);

        $statuses = [
            ['name' => 'new'],
            ['name' => 'in progress'],
            ['name' => 'completed'],
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }

        Lead::factory(10)->create();
    }
}
