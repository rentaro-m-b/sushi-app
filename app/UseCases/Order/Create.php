<?php
namespace App\UseCases\Order;

use App\Http\Requests\OrderRequest;
use App\Models\Order;

class Create{
    public function __invoke(OrderRequest $request){
        Order::create($request);
    }
}