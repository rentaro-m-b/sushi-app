<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\Option;
use App\Models\ItemOption;

class ItemOption extends Model
{
    use HasFactory;

    // public function item()
    // {
    //     return $this->belongsTo(Item::class);
    // }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public static function check_options(array $orders){
        foreach($orders as $order){
            if(array_key_exists('options', $order)){
                foreach($order['options'] as $option){
                    $result = ItemOption::where('item_id', $order['item_id'])->where('option_id', $option)->exists();
                    if(!$result){
                        return false;
                    }
                }
            }
        }
        return true;
    }
}
