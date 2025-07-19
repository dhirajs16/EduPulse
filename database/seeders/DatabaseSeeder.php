<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\AdminSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Ram Sharma',
            'email' => 'ram@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $this->call([
            RolePermissionSeeder::class,
            AdminSeeder::class
        ]);
    }
}
