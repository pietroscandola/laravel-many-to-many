<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Faker\Generator as Faker;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $tags = ['Presidente', 'CEO', 'Direttore Finanziario', 'Direttore Marketing', 'Direttore Tecnico', 'Capo della Sicurezza', 'HR Manager', 'Product Manager', 'Project Manager', 'Plant Manager'];

        foreach ($tags as $tag) {
            $new_tag = new Tag();
            $new_tag->label = $tag;
            $new_tag->color = $faker->hexColor();
            $new_tag->save();
        }
    }
}
