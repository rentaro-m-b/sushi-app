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
            'table_id' => [
                'required', 
                'integer', 
                'exists:tables,id',
            ],
            'orders.*.item_id' => [
                'required', 
                'integer',
                'exists:items,id,on_sale,1'
            ],
            'orders.*.options.*' => [
                'integer',
                'exists:options,id',
            ],
            'orders.*.volume' => [
                'integer',
                'exists:volumes,id',
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
