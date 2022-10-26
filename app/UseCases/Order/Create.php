<?php
namespace App\UseCases\Order;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Item;
use App\Models\OrderOption;
use Illuminate\Support\Facades\DB;

class Create{
    public function __invoke(OrderRequest $request){
        $customer_id = $request->input('customer_id');
        $orders = $request->input('orders');
        $items = [];
        $options = [];
        $volumes = [];
        
        $result = Order::check_orders($orders);
        if(is_string($result)){
            return $result;
        }

        foreach($orders as $index => $order){
            //DBにクエリを複数回投げることを避けるために、ordersに入る注文情報(option, volume以外)を配列で保存する。
            array_push($items, [
                'item_id' => $order['item_id'],
                'customer_id' => $customer_id,
                'price' => Item::select('price')->where('id', $order['item_id'])->first()['price'],
            ]);

            if(array_key_exists('options', $order)){
                //この時点では$indexは0~注文の個数になる(order_idとは噛み合っていない状態)
                foreach($order['options'] as $option){
                    array_push($options, ['order_id' => $index, 'option_id' => $option]);
                }
            }

            if(array_key_exists('volume', $order)){
                //この時点では$indexは0~注文の個数になる(order_idとは噛み合っていない状態)
                //テーブル上では、volumeはoptionに一括りなので、option_idというキーにする。
                array_push($volumes, ['order_id' => $index, 'option_id' => $order['volume']]);
            }
        }

        //ここでまとめてクエリを作成してDBに投げる
        //insertにすると、created_atが埋まらないため、upsertを使用
        //若干の懸念点は、lastInsertIdが、データベースの他クライアントからの要求で取得するIDが変わってしまう？
        //DBクラスを使ってしまっている点も気になる。
        Order::upsert($items, ['id']);
        $lastId = DB::getPdo()->lastInsertId();

        //元の配列(options)を変更する必要があるので、&optionとする。
        foreach($options as &$option){
            $option['order_id'] += $lastId;
        }

        foreach($volumes as &$volume){
            $volume['order_id'] += $lastId;
        }
        
        OrderOption::upsert($options, ['id']);
        OrderOption::upsert($volumes, ['id']);

        return true;
    }   
}
