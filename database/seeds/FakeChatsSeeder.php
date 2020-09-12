<?php

use App\ChatDialog;
use App\ChatDialogUser;
use App\ChatMessage;
use App\Event;
use App\Product;
use Illuminate\Database\Seeder;

class FakeChatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 14;
        $faker = Faker\Factory::create();

        $types = ['event', 'product'];

        for ($i = 0; $i < 10; $i++) {
            // $another_id = User::all()->except($id)->random(1)->pluck('id');
            $related = $types[array_rand($types)];
            if ($related == 'event') {
                $related_data = Event::all()->except('seller_id', $id)->random(1)->first();

            } else {
                $related_data = Product::all()->except('seller_id', $id)->random(1)->first();
            }


            $dialog = ChatDialog::updateOrCreate([
                // 'users' => json_encode([$id, $related_data->seller_id]),
                'related' => $related,
                'related_id' => $related_data->id,
            ]);

            $dialog_user = ChatDialogUser::updateOrCreate([
                'dialog_id'=> $dialog->id,
                'user_id'=> $related_data->seller_id
            ]);

            $dialog_user = ChatDialogUser::updateOrCreate([
                'dialog_id'=> $dialog->id,
                'user_id'=> $id
            ]);
            
            for ($j = 0; $j < 20; $j++) {
                // dd($another_id);
                $message = ChatMessage::create([
                    'dialog_id' => $dialog->id,
                    'user_id' => $j % 2 == 0 ? $id : $related_data->seller_id,
                    'message' => $faker->realText(30),
                    'message_type' => 'text',
                ]);

            }

        }

    }
}
