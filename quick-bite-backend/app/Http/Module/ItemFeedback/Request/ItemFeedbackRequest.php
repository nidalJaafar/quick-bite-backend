<?php

namespace App\Http\Module\ItemFeedback\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use function auth;

class ItemFeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'rating' => 'required|integer|min:0|max:5',
            'details' => 'string',
            'item_id' => 'required|exists:items,id|integer'
        ];

    }
}
