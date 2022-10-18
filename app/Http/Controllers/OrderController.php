<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\UseCases\Order\Create as CreateUseCase;
use App\Models\ItemOption;
use App\Models\Item;
use Illuminate\Database\Eloquent\Builder;


class OrderController extends Controller
{
    public function order(OrderRequest $request, CreateUseCase $createUC){
        $createUC->invoke($request);
    }

    // public function aiueo(OrderRequest $request){
    //     $orders = $request->input('orders');
    //     foreach($orders as $order){
    //         //適切なオプションが付与されているかの確認をする
    //         if(array_key_exists('options', $order)){
    //             foreach($order['options'] as $option){
    //                 $result = ItemOption::where('item_id', $order['item_id'])->where('option_id', $option)->exists();
    //                 if(!$result){
    //                     return response("不適切なオプションです");
    //                 }
    //             }
    //         }

    //         商品(item)が、寿司カテゴリでない、かつvolumeが付与されている場合にエラーを返す。
    //         ItemOption::find($order['item_id'])->category_id;
    //     }
    //     return response(var_dump($orders));
    // }

    // public function kaiueo(){
    //     $result = ItemOption::where('item_id', 2)->where('option_id', 1);//->exists();
    //     //$id = Item::select('category_id')->find(2)->get();//->first();//->select('category_id');
    //     return response(var_dump($result));
    // }
}