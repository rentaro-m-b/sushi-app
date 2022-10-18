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
        if(self::check_options($orders) && self::check_volumes($orders)){
            return true;
        }else{
            return false;
        }
    }


    private static function check_options(array $orders){
        foreach($orders as $order){
            if(array_key_exists('options', $order)){
                foreach($order['options'] as $option){
                    //ItemOptionテーブルに、レコードが存在しなければ不適切なオプション
                    $result = ItemOption::where('item_id', $order['item_id'])->where('option_id', $option)->exists();
                    if(!$result){
                        return false;
                    }
                }
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
