<?php

namespace App\Http\Requests\Apartments;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ApartmentsRequest extends FormRequest
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
        $rules_arr = [
            'district_id' => ['required'],
//            'name_en' => ['required'],
//            'name_tr' => ['required'],
//            'name_ru' => ['required'],
            'post' => [
                'dimensions:min_height=326',
                'dimensions:min_width=326',
                'mimes:jpg,png,jpeg,webp',
                'max:7000',
            ],
            'post_alt' => ['required'],
            'quadrature' => ['required'],
            'floor' => ['required'],
            'floors' => ['required'],
            'sea' => ['required'],
            'layout' => ['required'],
            'price' => ['required'],
        ];

        if (empty($this->id)) {
            array_unshift($rules_arr['post'], 'required');
        }
        return $rules_arr;
    }

    public function attributes()
    {
        return [
//            'name_en' => '"Название проекта EN"',
//            'name_tr' => '"Название проекта TR"',
//            'name_ru' => '"Название проекта RU"',
            'district_id' => '"Город и Район"',
            'post' => '"Изображение карточки"',
            'post_alt' => '"Описание изображения"',
            'quadrature' => '"Квадратура"',
            'layout' => '"Планировка"',
            'sea' => '"До моря"',
            'floor' => '"Этаж"',
            'floors' => '"Этажность дома"',
            'price' => '"Цена"',

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
