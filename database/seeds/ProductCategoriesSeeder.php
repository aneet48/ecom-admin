<?php

use App\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = config('constants.fixed_product_cats');

        foreach ($data as $key => $value) {
            $slug = Str::slug($value);
            ProductCategory::updateOrCreate(
                [
                    'slug' => $slug,
                ],
                [
                    'name' => $value,
                    'active' => 1,
                    'parent_id' => 0,
                ]);

        }

    }

}
