<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ZipCodeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'zipcode'   => ['required_if:city,null','numeric','digits_between:1,6','exists:zipcodes,zipcode'],
            'city'      => ['required_unless:zipcode,null','string'],
            'county'    => ['required_unless:city,null','string'],
            'street'    => ['string'],
            'number'    => ['integer'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message'   => 'Error(s) validating input',
            'data'    => $validator->errors()
        ], 500));
    }

    public function messages()
    {
        return [
            'county.required_unless'   => 'You need to specify County, City and optionally street to get zipcode',
            'city.required_unless'     => 'You need to specify County, City and optionally street to get zipcode',
        ];
    }
}
