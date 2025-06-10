<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            "site_name"=>"required|string|min:2|max:60",
            "logo"=>"nullable|image|mimes:png,jpg",
            "favicon"=>"nullable|image|mimes:png,jpg",
            "facebook"=>"required|url",
            "instagram"=>"required|url",
            "twitter"=>"required|url",
            "youtube"=>"required|url",
            "street"=>"required|string|max:70",
            "city"=>"required|string|max:40",
            "country"=>"required|string|max:30",
            "email"=>"required|string|email",
            "phone"=>"required",

        ];
    }
}
