<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'title' => 'required|min:5|max:255',
            'slug' => 'required|min:5|max:255|unique:posts',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'status' => 'required',
            'description' => 'required|min:20',
            'photo' => 'required',
            'tag_ids' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Post name is required',
            'title.min' => 'Post name is too short',
            'title.max' => 'Post name is too long',
            'slug.required' => 'Post slug is required',
            'slug.min' => 'Post slug is too short',
            'slug.max' => 'Post slug is too long',
            'slug.unique' => 'Post slug must be unique',
            'category_id.required' => 'Category is required',
            'sub_category_id.required' => 'Sub-category is required',
            'description.required' => 'Post description required',
            'description.min' => 'Post description is too short',
            'status.required' => 'Status is required',
            'photo.required' => 'Image is required',
            'tag_ids.required' => 'Tags is required'
        ];
    }
}
