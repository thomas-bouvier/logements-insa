<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Photo;
use Storage;

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
            'titre' => "required|min:10|max:140",
            'quartier' => "required|min:2|max:70",
            'description' => "required|min:140|max:2000",
            'surface' => "required|numeric|max:1000",
            'loyer' => "required|numeric|max:10000",
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
        if ($this->isMethod('put'))
        {
            if (!$this->session()->has('temp_folder_name'))
            {
                return count(Storage::disk('public')->files($this->segment(2) . '/original')) == 0;
            }
        }

        if ($this->session()->has('temp_folder_name'))
        {
            $path = 'temp/' . $this->session()->get('temp_folder_name');

            return count(Storage::disk('public')->files($path . '/original')) == 0;
        }

        return true;
    }
}
