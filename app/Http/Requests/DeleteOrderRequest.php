<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class DeleteOrderRequest extends FormRequest
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
            'customer' => [
                'required', 
                'integer', 
                'exists:customers,id',
            ],
            'order' => [
                'required',
                'integer',
                'exists:orders,id',
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

    public function validationData()
    {
        return array_merge($this->request->all(), [
            'customer' => $this->customer,
            'order' => $this->order,
        ]);
    }
}
