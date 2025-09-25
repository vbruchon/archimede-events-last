<?php

namespace Database\Seeders;

use App\Models\Structure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $structures = [
            [
              'name' => 'French Tech Alpes VR',
            ],
            [
               'name' => 'Valence Romans Agglo',
            ],
            [
               'name' => 'ESISAR'
            ],
            [
               'name' => 'REDA'
            ],
            [
               'name' => 'Digital League'
            ],
            [
               'name' => 'CCI'
            ],
            [
               'name' => 'Moulin Digital'
            ],
            [
               'name' => 'INITIACTIVE'
            ],
            [
               'name' => 'GENEO'
            ],
            [
                'name' => 'Fab.t'
            ],
            [
                'name' => 'Club Rovaltain'
            ],
            [
                'name' => 'CEV'
            ],
            [
                'name' => 'ERB'
            ],
            [
                'name' => 'Continuum'
            ],
            [
                'name' => 'CPME'
            ]
        ];
        foreach ($structures as $structureData) {
            Structure::create($structureData);
        };
    }
}
