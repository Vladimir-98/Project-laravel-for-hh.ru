<?php

namespace App\Http\Requests\District;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DistrictRequest extends FormRequest
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
            'name_en' => 'required',
            'city_id' => 'required',
            'name_tr' => 'required',
            'name_ru' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name_en' => '"Название района EN"',
            'city_id' => 'Город',
            'name_tr' => '"Название района TR"',
            'name_ru' => '"Название района RU"',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute обязательно к заполнению!',
        ];
    }

    public function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json(array_shift($errors))
        );
    }
}
