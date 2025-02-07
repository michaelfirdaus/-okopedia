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
            'product_name'     => 'Macbook Pro 15"',
            'product_category' => '1',
            'product_desc'     => 'Original Apple 100%',
            'product_price'    => 20000000,
            'product_image'    => 'macbook.jpg'
        ]);

        App\Product::create([
            'product_name'     => 'ASUS ROG Strix Hero II',
            'product_category' => '1',
            'product_desc'     =>  'ROG Strix Hero II GL504GM. Jaminan harga termurah dan garansi resmi dari ASUS.',
            'product_price'    => 21795000,
            'product_image'    => 'asusrog.jpg'
        ]);

        App\Product::create([
            'product_name'     => "ASUS ROG Phone 3",
            'product_category' => '2',
            'product_desc'     => 'ASUS ROG Phone 3, RAM 12GB/128GB 5G SnapDragon 865.',
            'product_price'    => 13000000,
            'product_image'    => 'rogphone.jpg'
        ]);

        App\Product::create([
            'product_name'     => "iPhone 11 Pro Max",
            'product_category' => '2',
            'product_desc'     => 'iPhone 11 Pro Max, garansi resmi iBox Indonesia dengan kapasitas memori 256GB.',
            'product_price'    => 22000000,
            'product_image'    => 'iphone.jpg'
        ]);

        App\Product::create([
            'product_name'     => "Samsung S10",
            'product_category' => '2',
            'product_desc'     => 'Samsung S10 5G SnapDragon 865, Garansi resmi dari TAM Indonesia.',
            'product_price'    => 18000000,
            'product_image'    => 'samsungs10.jpg'
        ]);
    }
}
