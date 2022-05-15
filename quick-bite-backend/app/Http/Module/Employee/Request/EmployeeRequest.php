<?php

namespace App\Http\Module\Employee\Request;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string',
            'image' => 'image|required',
            'position' => 'required|string|in:manager,chef,waiter',
            'fb_link' => 'string',
            'twitter_link' => 'string',
            'ig_link' => 'string'
        ];
    }
}
