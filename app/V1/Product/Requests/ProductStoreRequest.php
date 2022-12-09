<?php

namespace App\V1\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'     => 'integer|required|exists:users,id',
            'name'        => 'required|string',
            'amount'      => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'string|nullable',
            'qty'         => 'numeric|nullable',
        ];
    }
}
