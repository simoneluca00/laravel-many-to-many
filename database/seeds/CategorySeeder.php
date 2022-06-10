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
        // 1) array multidimensionale per "compilare" l'entità 'categories'
        $categories = [
            [
                'label' => 'List',
                'color' => 'danger'
            ],
            [
                'label' => 'Tutorial',
                'color' => 'primary'
            ],
            [
                'label' => 'Explanation',
                'color' => 'info'
            ],
            [
                'label' => 'News',
                'color' => 'secondary'
            ],
            [
                'label' => 'Opinion',
                'color' => 'success'
            ],
            [
                'label' => 'Case Study',
                'color' => 'warning'
            ],
            [
                'label' => 'Solution',
                'color' => 'light'
            ],
        ];

        // 2) ciclo foreach per far si che ogni singolo array corrisponda ad un record dell'entità
        foreach ($categories as $category) {
            
            $newCategory = new Category();

            // newCategory è una classe, quindi viene usata la "->" per riferirci ad una poprietà
            // categories è un'array multidimensionale, quindi vengono utilizzate le "['']" per riferirci ad una poprietà
            $newCategory->label = $category['label'];
            $newCategory->color = $category['color'];

            $newCategory->save();
        }
    }
}
