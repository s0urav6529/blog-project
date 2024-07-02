<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileStoreRequest extends FormRequest
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
            'user_id' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
            'address' => 'required|min:3|max:255',
            'phone' => 'required|numeric',
            'gender' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'User is required',
            'division_id.required' => 'Division is required',
            'district_id.required' => 'District is required',
            'thana_id.required' => 'Thana is required',
            'address.required' => 'Address is required',
            'phone.required' => 'Phone is required',
            'phone.numeric' => 'Phone number should be a number',
            'gender.required' => 'Status is required'
        ];
    }
}
