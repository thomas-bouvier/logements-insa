<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BidRequest extends FormRequest
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
            'name' => "required|min:20",
            'district' => "required|min:2",
            'description' => "required|min:140",
            'ground' => "required|numeric",
            'rental' => "required|numeric",
            'type_id' => "required|exists:types,id",
            'email' => "required|email",
        ];

        $photos = count($this->input('photos'));
        foreach (range(0, $photos) as $index)
        {
            $rules['photos.' . $index] = 'image|dimension:940,530|mimes:jpeg,bmp,png|max:5000';

            if ($index == 0)
            {
                if ($this->method() == 'POST')
                {
                    $rules['photos.' . $index] .= '|required';
                }
            }
        }

        return $rules;
    }
}
