<?php
namespace App\UseCases\Order;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Item;

class Create{
    public function __invoke(OrderRequest $request){
        $customer_id = $request->input('customer_id');
        $orders = $request->input('orders');
        
        $result = Order::check_orders($orders);
        if(is_string($result)){
            return $result;
        }

        foreach($orders as $order){
            Order::create([
                'item_id' => $order['item_id'],
                'customer_id' => $customer_id,
                'price' => Item::select('price')->where('id', $order['item_id'])->get(),
            ]);
        }

        return true;
    }
}
