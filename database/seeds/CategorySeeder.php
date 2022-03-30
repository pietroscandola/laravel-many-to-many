<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['label' => 'HTML', 'color' => 'secondary'],
            ['label' => 'CSS', 'color' => 'primary'],
            ['label' => 'Javascript', 'color' => 'danger'],
            ['label' => 'Vue', 'color' => 'success'],
            ['label' => 'Sql', 'color' => 'warning'],
            ['label' => 'PHP', 'color' => 'info'],
            ['label' => 'Laravel', 'color' => 'light'],
        ];

        foreach ($categories as $category) {
            $categoria = new Category();
            $categoria->label = $category['label'];
            $categoria->color = $category['color'];
            $categoria->save();
        }
    }
}
