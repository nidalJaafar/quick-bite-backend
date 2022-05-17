<?php

namespace App\Http\Module\Item\Request;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name' => 'required|string',
            'details' => 'required|string',
            'type' => 'required|in:plate,sandwich,dessert,drink|string',
            'base_price' => 'required|numeric',
            'sale' => 'required|min:0|max:100|integer',
            'menu_id' => 'required|integer|exists:menus,id',
            'is_trending' => 'boolean',
            'images' => 'array|required'
        ];
    }
}
