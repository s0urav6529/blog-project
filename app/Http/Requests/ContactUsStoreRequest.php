<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsStoreRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'subject' => 'required',
            'message' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required !',
            'email.required' => 'Email is required !',
            'email.email' => 'Invalid email address !',
            'phone.required' => 'Phone number is required !',
            'subject.required' => 'Subject is required !',
            'message.required' => 'Message is required !'
        ];
    }
}
