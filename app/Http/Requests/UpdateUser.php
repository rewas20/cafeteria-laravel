<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:4',
            'email' => ['required','email',Rule::unique('users')->ignore($this->user)] ,
            'role' => 'required',
            'image' => 'image|max:2048', 
        ];
    }

    function messages(){
        return [

            'name.required' =>"User should have a name",
            'name.min'=>'User name has to be at least 4 chars.',
            'email.email'=>'Invalid email.',
            'image.required' =>'image must have  proper extension filename',

        ];
    }
}
