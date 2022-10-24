<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Item;

class StoreRequest extends FormRequest
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
            "name" => ['required', 'string', 'unique:items', 'max:400'],
            "category_id" => ['required', 'integer'],
            "price" => ['required', 'integer'],
            "stock" => ['required', 'integer'],
            // optionsは現在テーブルを用意していない。
            "options.*" => ['string', 'max:400'],
            "on_sale" => ['required', 'boolean']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => 400,
            'errors' => $validator->errors(),
        ],400);
        throw new HttpResponseException($response);
    }

    public function makeItem(): Item
    {
        return new Item($this->validated());
    }
}
