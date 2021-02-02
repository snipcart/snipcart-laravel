<?php

use Illuminate\Database\Seeder;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredients')->insert([
            // Oats
            [
                'name' => 'Quick Oats',
                'description' => '100% whole grain oats (quick cooking)',
                'category' => 'oats',
                'price_per_gram' => 0.007,
            ],
            [
                'name' => 'Large Flake Oats',
                'description' => 'Old-fashioned rolled oats that are left large and thick for great taste and lots of texture',
                'category' => 'oats',
                'price_per_gram' => 0.01,
            ],
            [
                'name' => 'Organic Oats Rolled Thick',
                'description' => 'These extra chewy oats produce distinctly robust, European-style cereals and yeast breads',
                'category' => 'oats',
                'price_per_gram' => 0.01,
            ],
            // seeds
            [
                'name' => 'Chia Seeds',
                'description' => 'Provide you with 100% of your daily requirement of omega-3s',
                'category' => 'seeds',
                'price_per_gram' => 0.02,
            ],
            [
                'name' => 'Hemp Seeds',
                'description' => 'Versatile super seeds that add plant protein and healthy fats',
                'category' => 'seeds',
                'price_per_gram' => 0.02,
            ],
            [
                'name' => 'Flax Seeds',
                'description' => 'Excellent source of protein, fiber, iron, and calcium',
                'category' => 'seeds',
                'price_per_gram' => 0.01,
            ],
            // Milk Products
            [
                'name' => '2% Milk',
                'description' => 'Boring milk',
                'category' => 'milk products',
                'price_per_gram' => 0.005,
            ],
            [
                'name' => '3% Milk',
                'description' => 'Slightly less boring milk',
                'category' => 'milk products',
                'price_per_gram' => 0.007,
            ],
            [
                'name' => 'Green Milk',
                'description' => 'The only true way to live like Luke Skywalker',
                'category' => 'milk products',
                'price_per_gram' => 0.02,
            ],
            [
                'name' => 'Greek Yogurt',
                'description' => 'Plain Greek Yogurt',
                'category' => 'milk products',
                'price_per_gram' => 0.015,
            ],
            // sweeteners
            [
                'name' => 'Vanilla Extract',
                'description' => null,
                'category' => 'sweeteners',
                'price_per_gram' => 0.03,
            ],
            [
                'name' => 'Honey',
                'description' => null,
                'category' => 'sweeteners',
                'price_per_gram' => 0.03,
            ],
            [
                'name' => 'Maple Sirup',
                'description' => null,
                'category' => 'sweeteners',
                'price_per_gram' => 0.03,
            ],
            [
                'name' => 'Chocolate Chips',
                'description' => null,
                'category' => 'sweeteners',
                'price_per_gram' => 0.025,
            ],
            [
                'name' => 'Cinnamon',
                'description' => null,
                'category' => 'sweeteners',
                'price_per_gram' => 0.02,
            ],
            // Proteins
            [
                'name' => 'Protein Powder',
                'description' => 'Extremely recommended for CrossFit addicts',
                'category' => 'proteins',
                'price_per_gram' => 0.05,
            ],
            [
                'name' => 'Almonds',
                'description' => 'The almonds who excaped the dairy farm',
                'category' => 'proteins',
                'price_per_gram' => 0.03,
            ],
            [
                'name' => 'Peanut Butter',
                'description' => '',
                'category' => 'proteins',
                'price_per_gram' => 0.02,
            ],
            // fruits
            [
                'name' => 'Bananas',
                'description' => 'Perfectly sliced bananas',
                'category' => 'fruits',
                'price_per_gram' => 0.03,
            ],
            [
                'name' => 'Apples',
                'description' => 'Not to be compared with oranges',
                'category' => 'fruits',
                'price_per_gram' => 0.025,
            ],
            [
                'name' => 'Berries',
                'description' => 'A mix of small fruits goodness',
                'category' => 'fruits',
                'price_per_gram' => 0.03,
            ],
            [
                'name' => 'Tomatoes',
                'description' => 'Keeping up the debate',
                'category' => 'fruits',
                'price_per_gram' => 0.03,
            ]
        ]);
    }
}
