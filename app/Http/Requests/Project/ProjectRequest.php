<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProjectRequest extends FormRequest
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
            'name_en' => ['required'],
            'name_tr' => ['required'],
            'name_ru' => ['required'],
            'deadline' => ['required'],
            'sea' => ['required'],
            'layouts' => ['required'],
            'price' => ['required'],
            'catalog' => [
                'dimensions:min_height=320',
                'dimensions:min_width=520',
                'mimes:jpg,png,jpeg,webp',
                'max:7000',
            ],
//            'post' => [
//                'dimensions:min_height=326',
//                'dimensions:min_width=326',
//                'mimes:jpg,png,jpeg,webp',
//                'max:7000',
//            ],
            'logo' => [
                'dimensions:min_height=55',
                'dimensions:min_width=77',
                'mimes:jpg,png,jpeg,webp',
                'max:7000',
            ],
//            'post_alt' => ['required'],
            'catalog_alt' => ['required'],
            'logo_alt' => ['required'],
        ];

        if (empty($this->id)) {
            array_unshift($rules_arr['catalog'], 'required');
//            array_unshift($rules_arr['post'], 'required');
            array_unshift($rules_arr['logo'], 'required');
        }
        return $rules_arr;
    }

    public function attributes()
    {
        return [
            'name_en' => '"Название проекта EN"',
            'name_tr' => '"Название проекта TR"',
            'name_ru' => '"Название проекта RU"',
            'district_id' => '"Город и Район"',
//            'post' => '"Изображение карточки"',
            'catalog' => '"Изображение каталога"',
            'logo' => '"Логотип"',
//            'post_alt' => '"Описание изображения"',
            'catalog_alt' => '"Описание изображения каталога"',
            'logo_alt' => '"Описание изображения логотипа"',
            'layouts' => '"Планировки"',
            'price' => '"Цены"',
            'sea' => '"До моря"',
            'deadline' => '"Срок сдачи"',
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
