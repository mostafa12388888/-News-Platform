<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class updateAdminRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'userName' => [
                'required',
                'string',
                'max:50',
                Rule::unique('admins', 'user_name')->ignore($this->id)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',"unique:admins,email,".$this->id
            ],
            'password' => ['string', 'min:8', 'confirmed'],
            "status" => "required|in:0,1",
            'role' => "required|exists:authorizations,id"
        ];
    }
}
