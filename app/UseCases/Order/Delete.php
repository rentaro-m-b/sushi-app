<?php
namespace App\UseCases\Order;

use App\Models\Customer;
use App\Models\Order;

class Delete{
    public function __invoke(Customer $customer, Order $order){
        if($customer != $order->customer()->first()){
            //削除対象の注文に紐づくcustomerが、指定されたcustomerと一致していない場合
            return [0 => '削除対象の注文は、指定したcustomerの注文ではありません'];
        }elseif($customer->paid){
            //会計済みのcustomerの注文は削除できない
            return [0 => 'そのcustomerは既に会計済みです'];
        }else{
            $order->order_options()->delete();
            $order->delete();
            return [1 =>'削除完了'];
        }
    }
}
