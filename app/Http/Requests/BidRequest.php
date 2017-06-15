<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Photo;

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
            'email' => "required|email"
        ];

        return $rules;
    }

    public function validator($factory)
    {
        $validator = $factory->make(
            $this->all(), $this->container->call([$this, 'rules']), $this->messages(), $this->attributes()
        );

        $validator->after(function($validator)
        {
            if ($this->noPhoto())
            {
                $validator->errors()->add('file', 'L\'annonce doit comporter au moins une photo.');
            }
        });

        return $validator;
    }

    private function noPhoto()
    {
        return Photo::where('bid_id', $this->segment(2))->count() == 0;
    }
}
