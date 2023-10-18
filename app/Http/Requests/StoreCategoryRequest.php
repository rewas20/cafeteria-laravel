<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
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
            //
            'name' => 'required|unique:categories|min:2'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Category name cannot be empty',
            'name.unique' => 'A Category with this name already exist',
            'name.min' => 'Category name must have at least 2 characters',
        ];
    }
}
