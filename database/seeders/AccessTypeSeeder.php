<?php

namespace Database\Seeders;

use App\Models\AccessType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accessTypes = [
            ['name' => 'Ouvert'],
            ['name' => 'Fermé']
        ];
        foreach($accessTypes as $accessType){
            AccessType::create($accessType);
        }
    }
}
