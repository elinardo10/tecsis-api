<?php

namespace App\V1\Customer\Requests;

use App\V1\Business\Rules\UserBelongToBusiness;
use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'business_id'     => ['integer', 'required', new UserBelongToBusiness()],
            'first_name'      => 'required|string',
            'last_name'       => 'string|nullable',
            'email'           => 'email|required',
            'password'        => 'string|min:6|sometimes',
            'contact_number'  => 'string|nullable',
            'whatsapp_number' => 'string|nullable',
            'dob'             => 'date|nullable',
            'gender'          => 'string|nullable',
            'document_type'   => 'string|nullable',
            'document'        => 'string|nullable',
            'full_address'    => 'string|nullable',
        ];
    }
}
