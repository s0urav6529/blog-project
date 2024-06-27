<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
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
            'post_id' => 'required',
            'comment' => 'required|min:2|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'post_id.required' => 'Post is required',
            'comment.min' => 'Comment is too short',
            'comment.max' => 'Comment is too long'
        ];
    }
}
