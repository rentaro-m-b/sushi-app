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
        'table_id',
        'paid'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public static function check_orders(array $orders){
        return self::check_options($orders) && self::check_volumes($orders);
    }


    private static function check_options(array $orders){
        foreach($orders as $order){
            //付与されたオプションの個数と、ItemOptionから取得するレコードが等しくない＝不適切なオプションがある
            //上記の状況ではfalseを返す
            $options = $order['options'];
            $result = ItemOption::where('item_id', $order['item_id'])->whereIn('option_id', $options)->get();
            if(count($result) != count($options)){
                return false;
            }
        }
        return true;
    }

    private static function check_volumes(array $orders){
        foreach($orders as $order){
            $id = $order['item_id'];
            //注文商品のcategory_idが1でない(寿司カテゴリでない)andボリューム指定の場合にfalseを返す
            if(array_key_exists('volume', $order) && (Item::find($id)["category_id"] != 1)){
                return false;
            }
        }
        return true;
    }
}
