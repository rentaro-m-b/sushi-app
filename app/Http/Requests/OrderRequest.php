<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
//use App\Models\Item;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'table_id' => [
                'required', 
                'integer', 
                'exists:tables,id',
            ],
            //商品(item_id)が、寿司カテゴリに属しているかで条件分岐(ドリンクの場合はvolumeがなくても良い)
            //optionsのバリデーション中からitem_idの取得方法
            'orders.*.item_id' => [
                'required', 
                'integer',
                Rule::exists('items, id')->where(function ($query) {
                    $query->where('on_sale', true);
                }),
            ],
            // 'orders.*.options.*' => [
            //     'integer',
            //     'exists:options,id',
            //     Rule::exists('options,')
            // ],
            'orders.*.volume' => [
            ]
        ];
    }
}
