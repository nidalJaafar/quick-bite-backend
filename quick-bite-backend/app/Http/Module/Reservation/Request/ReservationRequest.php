<?php

namespace App\Http\Module\Reservation\Request;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
    public function rules()
    {
        return [
            'number_of_people' => 'integer|required',
            'date' => 'date_format:"Y-m-d H:i"|required|after:'. date('Y-m-d H:i'),
            'status' => 'string|in:pending,in restaurant,done'
        ];
    }
}
