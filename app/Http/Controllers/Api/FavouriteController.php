<?php

namespace App\Http\Controllers\Api;

use App\Favourite;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavouriteController extends Controller
{

    public function addAndRemove(Request $request)
    {
        

        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'type_id' => 'required',
            'user_id' => 'required',
            'action'=>'required'
  
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        if($request->get('action')=='add'){

            $exist = Favourite::where(['type'=>$request->get('type'),'type_id'=>$request->get('type_id'),'user_id' => $request->get('user_id')])->first();
            if(!empty($exist)){
                $msg = 'Already added to favourites';
                $error = true;
            }else{

                $favourite = Favourite::create([
                    'type' => $request->get('type'),
                    'type_id' => $request->get('type_id'),
                    'user_id' => $request->get('user_id'),
              
                ]);
                $msg = 'Added to favourites';
                $error = false;
            }
        }else{
            Favourite::where(['type'=>$request->get('type'),'type_id'=>$request->get('type_id'),'user_id' => $request->get('user_id')])->delete();
            $error = false;
            $msg = 'Removed from favourites';
        }

        $fav = $this->getUsersFavouriteData($request->get('user_id'));
       
        $body = [
            'favourite' => @$favourite,
            'favEvents'=> @$fav ? $fav['events']: [],
            'favProducts'=> @$fav ? $fav['products']: []
        ];

        return generate_response($error, $msg, $body);
    }

    public function delete(Request $request,$id)
    {
        $favourite = Favourite::where('id', $id)->delete();
        $msg = $favourite ? 'Remove from favourite successfully' : "favourite not Found";
        $error = $favourite ? false : true;

        return generate_response($error, $msg);
    }

    public function userFavourites(Request $request,$user_id,$type){

        $query = Favourite::with(['event.images','event.university','event.category','product','product.images','product.university','product.category'])->where(['user_id'=>$user_id,'type'=>$type])->orderBy('id', 'DESC');
        $paginate = $request->has('paginate') ? $request->get('paginate') : 12;

        $list = $query->orderBy('id', 'DESC')->paginate($paginate);
        return response()->json($list);
    }
    public function getUsersFavouriteData($user_id){
        $favEvents   = Favourite::where(['type'=>'event','user_id'=>$user_id])->select('type_id')->get();
        $favProducts = Favourite::where(['type'=>'product','user_id'=>$user_id])->select('type_id')->get();
        $events= [];
        $products= [];
        if(!empty($favEvents)){
            foreach($favEvents as $evt){
                $events[] = $evt['type_id'];
            }
        }

        if(!empty($favProducts)){
            foreach($favProducts as $prd){
                $products[] = $prd['type_id'];
            }
        }

        return ['events'=>$events,'products'=>$products];
    }
    
}
