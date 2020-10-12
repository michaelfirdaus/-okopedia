<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Product::create([
            'product_name' => 'Macbook Pro 15"',
            'product_category' => 'Laptop',
            'product_desc' => 'Original Apple 100%',
            'product_price' => 'Rp20.000.000',
            'product_image' => 'an Image'
        ]);
    }
}
