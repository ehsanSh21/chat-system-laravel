<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {

        $rules = [
            'name'=>'required',
            'last_name'=>'required',
        ];

        if($this->method() == self::METHOD_POST){
            $rules['password'] = ['required'];
            $rules['phone']=['required','unique:users,phone'];
            $rules['email']=['required','email','unique:users,email'];

        }

        if($this->method() == self::METHOD_PATCH){
//            dd($this->user->id);
            $rules['phone']=['required',Rule::unique('users','phone')->ignore($this->user->id)];
            $rules['email']=['required',Rule::unique('users','email')->ignore($this->user->id)];
        }

        return $rules;

    }
}
