<?php
namespace App\UseCases\Order;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\ItemOption;

class Create{
    public function invoke(OrderRequest $request){
        $table_id = $request->input('table_id');
        $orders = $request->input('orders');

        if(!ItemOption::check_options($orders)){
            return false;
        }
        
        foreach($orders as $order){
            Order::create([
                'item_id' => $order['item_id'],
                'table_id' => $table_id,
                'paid' => false
            ]);
        }

        return true;

        // foreach($orders as $order){
        //     //orderは配列(連想配列)
        //     //注文にoptionsが含まれているかを確認
        //     if(array_key_exists('options', $order)){
        //         foreach($order['options'] as $option){
        //             $result = ItemOption::where('item_id', $order['item_id'])->where('option_id', $option)->exists();
        //             if(!$result){
        //                 return response("不適切なオプションです");
        //             }
        //         }
        //     };
        
        //     //商品(item)が、寿司カテゴリでない、かつvolumeが付与されている場合にエラーを返す。(後で実装)
        //     //ItemOption::find($order['item_id'])->category_id;
        //     Order::create([
        //         'item_id' => $order['item_id'],
        //         'table_id' => $table_id,
        //         'paid' => false
        //     ]);
        // }
    }
}