<?php

use App\EventCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = config('constants.fixed_event_cats');

        foreach ($data as $key => $value) {
            $slug = Str::slug($value);
            EventCategory::updateOrCreate(
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
