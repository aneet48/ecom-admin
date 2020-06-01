<?php

use App\ProductCategory;
use App\ProductImage;
use App\University;
use App\User;
use Illuminate\Database\Seeder;
use Intervention\Image\Facades\Image as Image;

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
        $img_ids = [
            0, 1, 10, 100, 1000, 1001, 1002, 1003, 1004, 1005, 1006, 1008, 1009, 1010, 101, 1011, 1012, 1013, 1014, 1015, 1016, 1018,
            1020, 1021, 1022, 1023, 1024, 1025,
        ];

        for ($i = 0; $i < 20; $i++) {
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

            for ($j = 0; $j < 2; $j++) {
                $path = 'https://i.picsum.photos/id/' . $img_ids[array_rand($img_ids)] . '/600/400.jpg';
                $filename = 'pimg_' . time() . rand(10, 999) . '.jpg';

                Image::make($path)->save(public_path('storage/products/' . $filename));

                // $image = $faker->image('public/storage/products', 640, 480, null, false);
                ProductImage::create([
                    'name' => $filename,
                    'product_id' => $product->id,
                ]);

                # code...
            }

        }

    }
}
