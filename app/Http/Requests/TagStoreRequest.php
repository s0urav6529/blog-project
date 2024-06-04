<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagStoreRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:tags',
            'order_by' => 'required|numeric',
            'status' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tag name is required',
            'name.min' => 'Tag name is too short',
            'name.max' => 'Tag name is too long',
            'slug.required' => 'Tag slug is required',
            'slug.min' => 'Tag slug is too short',
            'slug.max' => 'Tag slug is too long',
            'slug.unique' => 'Tag slug must be unique',
            'order_by.required' => 'Serial number required',
            'order_by.numeric' => 'Serial should be a number',
            'status.required' => 'Status is required'
        ];
    }
}
