<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\Recommend\Get as GetUseCase;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\ItemOption;

class RecommendController extends Controller
{
    public function recommend_items(GetUseCase $getUC){
        $items = $getUC();
        //return response(var_dump(ItemResource::collection($items)));
        return response([
            'data' => ItemResource::collection($items)
        ]);
    }

    public function aiueo($id){
        return response(Item::find($id)->itemoptions()->get());
    }
}
