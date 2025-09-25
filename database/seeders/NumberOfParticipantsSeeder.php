<?php

namespace Database\Seeders;

use App\Models\NumberOfParticipants;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NumberOfParticipantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numberOfParticipants = [
            ['name' => 'Moins de 20 personnes'],
            ['name' => 'De 20 à 50 personnes'],
            ['name' => 'De 50 à 100 personnes'],
            ['name' => 'De 100 à 250 personnes'],
            ['name' => 'Plus de 250 personnes']
        ];
        foreach($numberOfParticipants as $participants){
            NumberOfParticipants::create($participants);
        }
    }
}
