<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\ItemOption;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'customer_id',
        'price',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public static function check_orders(array $orders){
        if(is_string($result = self::check_options($orders))){
            return $result;
        }

        if(is_string($result = self::check_volume($orders))){
            return $result;
        }

        return true;
        //return self::check_options($orders) && self::check_volumes($orders);
    }


    private static function check_options(array $orders){
        foreach($orders as $index => $order){
            //付与されたオプションの個数と、ItemOptionから取得するレコードが等しくない＝不適切なオプションがある
            //上記の状況ではfalseを返す
            //OrderRequestで、optionsの中にはvolumeに関するoptionがないことは保証されている
            //ただしoptionsが付与されていない可能性がある。この場合は次の注文を検証。
            if(!array_key_exists('options', $order)){
                continue;
            }
            $input_options = $order['options'];

            //ここで、適切なオプションだけを取得する。コレクションクラスのオブジェクト。
            $result = ItemOption::select('option_id')->where('item_id', $order['item_id'])->whereIn('option_id', $input_options)->get();
            $approved_options = [];
            foreach($result as $option){
                //コレクションの要素を配列に変換
                array_push($approved_options, $option['option_id']);
            }

            //入力されたオプションと、実際に使用できるオプションを比較して、差分を$diffに代入
            //$diffが空でない=差分があるので、エラー文字列を作成
            $diff = array_diff($input_options, $approved_options);
            if(!empty($diff)){
                $index+=1;
                $error_message = "{$index}番目の注文の";
                foreach($diff as $key => $value){
                    $key = $key + 1;
                    $error_message.="{$key}番目の{$value}\n";
                }
                $error_message.='というオプションが間違っています';
                return $error_message;
            }
        }
        return true;
    }

    private static function check_volume(array $orders){
        foreach($orders as $key => $order){
            if(array_key_exists('volume', $order)){
                $result = ItemOption::where('item_id', $order['item_id'])->where('option_id', $order['volume'])->first();
                if(is_null($result)){
                    $key += 1;
                    return "{$key}番目の商品のvolumeが不適切です";
                }
            }else{
                continue;
            }
        }
        return true;
    }
}
