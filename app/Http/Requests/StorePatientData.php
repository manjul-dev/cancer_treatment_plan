<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientData extends FormRequest
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
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'phone' => ['required','regex:/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[123456789]\d{9}$/'],
            'attachment' => 'required',
            'state' => 'required|exists:cities,state',
            'city' => 'required|exists:cities,city',
            'address' => 'required',
            'pin' => 'required|max:6|min:6|regex:/^[1-9][0-9]{5}$/',
            'type' => 'required|exists:cancers,type',
            'attachment.*' => 'max:10240|mimes:jpeg,jpg,flv,mp4,m3u8,ts,3gp,mov,avi,wmv'
        ];
        return $rules;
    }
}
