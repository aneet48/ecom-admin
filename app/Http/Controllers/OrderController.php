<?php

namespace App\Http\Controllers;

use App\Event;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $order = Order::updateOrCreate([
            'reciept_id' => $request->get('reciept_id'),
            'type' => $request->get('type'),
        ], [

            'rzp_order_id' => $request->get('rzp_order_id'),
            'rzp_transaction_id' => $request->get('rzp_transaction_id'),
            'status' => $request->get('status'),
            'price' => $request->get('price'),
            'user_id' => $request->get('user_id'),

        ]);

        if ($request->get('type') == 'event' && $order) {
            $event = Event::where('id', $request->get('event_id'))->update([
                'order_id' => $order->id,
                'active' => true,
                'coupan_id'=> $request->get('promo_code_id')
            ]);
        }
        $msg = $order ? 'Order created successfully' : "Order not Found";
        $error = $order ? false : true;
        $body = [
            'order' => $order,
            'event' => $event
        ];

        return generate_response($error, $msg, $body);
    }
}
