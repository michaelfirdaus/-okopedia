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
            'product_category' => '1',
            'product_desc' => 'Original Apple 100%',
            'product_price' => 'Rp20.000.000',
            'product_image' => 'uploads/product_img/macbook.jpg'
        ]);

        App\Product::create([
            'product_name' => 'ASUS ROG Strix Hero II',
            'product_category' => '1',
            'product_desc' =>  'ROG Strix Hero II GL504GM. Jaminan harga termurah dan garansi resmi dari ASUS.',
            'product_price' => 'Rp21.795.000',
            'product_image' => 'uploads/product_img/asusrog.jpg'
        ]);

        App\Product::create([
            'product_name' => "ASUS ROG Phone 3",
            'product_category' => '2',
            'product_desc' => 'ASUS ROG Phone 3, RAM 12GB/128GB 5G SnapDragon 865.',
            'product_price' => 'Rp13.000.000',
            'product_image' => 'uploads/product_img/rogphone.jpg'
        ]);

        App\Product::create([
            'product_name' => "iPhone 11 Pro Max",
            'product_category' => '2',
            'product_desc' => 'iPhone 11 Pro Max, garansi resmi iBox Indonesia dengan kapasitas memori 256GB.',
            'product_price' => 'Rp22.000.000',
            'product_image' => 'uploads/product_img/iphone.jpg'
        ]);

        App\Product::create([
            'product_name' => "Samsung S10",
            'product_category' => '2',
            'product_desc' => 'Samsung S10 5G SnapDragon 865, Garansi resmi dari TAM Indonesia.',
            'product_price' => 'Rp18.000.000',
            'product_image' => 'uploads/product_img/samsungs10.jpg'
        ]);
    }
}
