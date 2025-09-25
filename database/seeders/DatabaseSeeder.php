<?php

namespace Database\Seeders;

use App\Models\AccessType;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(StructureSeeder::class);
        $this->call(NumberOfParticipantsSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(AccessTypeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EventSeeder::class);
    }
}
