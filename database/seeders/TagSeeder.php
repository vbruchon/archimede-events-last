<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Innovation technologique'],
            ['name' => 'Transformation numérique'],
            ['name' => 'IA'],
            ['name' => 'Startups'],
            ['name' => 'Marketing digital'],
            ['name' => 'Entrepreneuriat'],
            ['name' => 'Leadership numérique'],
            ['name' => 'Stratégie digitale'],
            ['name' => 'Réseaux sociaux']
        ];
        foreach($tags as $tag){
            Tag::create($tag);
        }
    }
}
