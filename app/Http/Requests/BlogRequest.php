<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class BlogRequest extends FormRequest
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
//        dd($this->blog->id);
        $rules = [
            'title'=>['required',Rule::unique('blogs','title')],
            'body'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'user_id'=>'required',
        ];

        if($this->method() == self::METHOD_PATCH){
            $rules['title'] = ['required',Rule::unique('blogs','title')->ignore($this->blog->id)];
        }

        return $rules;
    }
}
