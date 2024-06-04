<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryStoreRequest extends FormRequest
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
            'slug' => 'required|min:3|max:255|unique:sub_categories',
            'category_id' => 'required',
            'order_by' => 'required|numeric',
            'status' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Sub-category name is required',
            'name.min' => 'Sub-category name is too short',
            'name.max' => 'Sub-category name is too long',
            'slug.required' => 'Sub-category slug is required',
            'slug.min' => 'Sub-category slug is too short',
            'slug.max' => 'Sub-category slug is too long',
            'slug.unique' => 'Sub-category slug must be unique',
            'category_id.required' => 'Category is required',
            'order_by.required' => 'Serial number required',
            'order_by.numeric' => 'Serial should be a number',
            'status.required' => 'Status is required'
        ];
    }
}
