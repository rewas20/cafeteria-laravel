<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewUser extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'image' => 'required',
            'room' => 'required|string|max:255',
            'role' => 'required',
        ];

    }
    public function messages(){
        return [

            'name.required' =>"User should have a name",
            'name.min'=>'  User name has to be at least 4 chars.',
            'email.email'=>'Invalid email.',
            'password.required' =>"User should have a password ",
            'password.min' =>"password should be at least 8 characters",
            'image.required' =>'image must have  proper extension filename',
            'confirmed.required' =>'password should match eachother',
            'room.required'=>' Room input is empty',
           
    
        ];
    }
    
};
