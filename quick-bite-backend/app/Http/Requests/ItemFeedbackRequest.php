<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rules = [
            'rating' => 'required|integer|min:0|max:5',
            'details' => 'string',
            'item_id' => 'required|exists:items,id|integer'
        ];
        $unique = Rule::unique('item_feedbacks')->where(function ($query) {
            $query->where('item_id', $this->item_id)
                ->where('user_id', auth()->user()->id);
        });
        if ($this->method() == 'POST')
            $rules['item_id'] .= "|$unique";

        return $rules;
    }
}
