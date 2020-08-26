<?php

use App\EventCategory;
use App\EventMedia;
use App\University;
use App\User;
use Illuminate\Database\Seeder;
use Intervention\Image\Facades\Image as Image;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $imges = [
            'https://images.pexels.com/photos/4319001/pexels-photo-4319001.jpeg',
            'https://images.pexels.com/photos/3309967/pexels-photo-3309967.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/1078958/pexels-photo-1078958.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
            'https://images.pexels.com/photos/1435735/pexels-photo-1435735.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
            'https://images.pexels.com/photos/210617/pexels-photo-210617.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
            'https://images.pexels.com/photos/1884581/pexels-photo-1884581.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        ];
        $links = [
            'https://www.google.com/',
            'https://laravel.com/',
            'http://woodbox.herokuapp.com',
            'https://twitter.com/',
            'https://yotube.com/',
            'http://woodbox.herokuapp.com/products',
        ];
        $social_profiles = [
            ['text' => 'Facebook',
                'link' => 'https://facebook.com'],
            ['text' => 'Twitter',
                'link' => 'https://twitter.com'],
            ['text' => 'Instagram',
                'link' => 'https://instagram.com'],
        ];
        $y = rand(2020, 2035);
        $mon = rand(1, 12);
        $d = rand(1, 28);
        $h = rand(0, 23);
        $m = rand(0, 59);
        $s = rand(0, 59);
        for ($i = 0; $i < 40; $i++) {
            $university = University::all()->random(1)->first();
            $category = EventCategory::all()->random(1)->first();
            $seller = User::all()->random(1)->first();

            $event = App\Event::create([
                'title' => $faker->realText($maxNbChars = 50),
                'description' => $faker->text,
                'seller_id' => $seller->id,
                'price' => $faker->numberBetween($min = 500, $max = 9000),
                'event_date' => $y . '-' . $mon . '-' . $d,
                'event_time' => $h . ':' . $m . ':' . $s,
                'contact_number' => $faker->numberBetween($min = 1000000000, $max = 9999999999),
                'book_event_link' => $links[$faker->numberBetween($min = 0, $max = 5)],
                'visit_website_link' => $links[$faker->numberBetween($min = 0, $max = 5)],
                'category_id' => $category->id,
                'social_profiles' => $social_profiles,
                'active' => true,
                'university_id' => $university->id,
            ]);

            for ($j = 0; $j < 2; $j++) {
                $path = $imges[array_rand($imges)];
                // $path = 'https://i.picsum.photos/id/' . $img_ids[array_rand($img_ids)] . '/600/400.jpg';
                $filename = 'pimg_' . time() . rand(10, 999) . '.jpg';

                Image::make($path)->save(public_path('storage/events/' . $filename));

                // $image = $faker->image('public/storage/products', 640, 480, null, false);
                EventMedia::create([
                    'name' => $filename,
                    'type' => 'image',
                    'thumbnail' => $filename,
                    'event_id' => $event->id,
                ]);

                # code...
            }

        }
    }
}
