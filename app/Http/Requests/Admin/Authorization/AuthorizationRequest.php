<?php

namespace App\Http\Requests\Admin\Authorization;

use Illuminate\Foundation\Http\FormRequest;

class AuthorizationRequest extends FormRequest
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
            "role"=>"required|string|min:2|max:40",
            "permissions"=>"required|array|min:1",
            "permissions.*"=>"required"
        ];
    }
}
