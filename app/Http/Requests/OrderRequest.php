<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Models\Item;

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
            'customer_id' => [
                'required', 
                'integer', 
                'exists:customers,id',
            ],
            'orders.*.item_id' => [
                'required', 
                'integer',
                'exists:items,id,on_sale,1'
            ],
            //optionsに存在し、かつvolume=falseであれば通常オプション
            'orders.*.options.*' => [
                'integer',
                'exists:options,id,volume,0',
            ],
            //optionsに存在し、かつvolume=trueであれば通常オプション
            'orders.*.volume' => [
                'integer',
                'exists:options,id,volume,1',
            ]
        ];
    }

    protected function failedValidation(Validator $validator) {
        $res = response()->json([
            'status' => 400,
            'errors' => $validator->errors(),
        ], 400);
        throw new HttpResponseException($res);
    }
}
