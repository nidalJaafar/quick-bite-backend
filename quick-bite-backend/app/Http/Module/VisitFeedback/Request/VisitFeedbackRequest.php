<?php

namespace App\Http\Module\VisitFeedback\Request;

use Illuminate\Foundation\Http\FormRequest;

class VisitFeedbackRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'rating' => 'required|min:0|max:5|integer',
            'details' => 'string'
        ];
    }
}
