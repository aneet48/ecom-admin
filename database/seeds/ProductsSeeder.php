<?php

use App\ProductCategory;
use App\ProductImage;
use App\University;
use App\User;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $type = ['Buy', 'Rental'];

        for ($i = 0; $i < 50; $i++) {
            $university = University::all()->random(1)->first();
            $seller = User::all()->random(1)->first();
            $category = ProductCategory::all()->random(1)->first();
            $product = App\Product::create([
                'title' => $faker->realText($maxNbChars = 50),
                'description' => $faker->text,
                'price' => $faker->numberBetween($min = 500, $max = 9000),
                'seller_id' => $seller->id,
                'category_id' => $category->id,
                'active' => true,
                'university_id' => $university->id,
                'type' => $type[array_rand($type)],
            ]);

            for ($i = 0; $i < 3; $i++) {
                $image = $faker->image('public/storage/products', 640, 480, null, false);
                ProductImage::create([
                    'name' => $image,
                    'product_id' => $product->id,
                ]);

                # code...
            }

        }

    }
}
