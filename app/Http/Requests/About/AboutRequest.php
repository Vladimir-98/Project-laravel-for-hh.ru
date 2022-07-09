<?php

namespace App\Http\Requests\About;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AboutRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title_about_en' => ['required'],
            'title_about_tr' => ['required'],
            'title_about_ru' => ['required'],
            'description_about_en' => ['required'],
            'description_about_tr' => ['required'],
            'description_about_ru' => ['required'],
            'about_gable_id' => ['required'],
            'about_gable_type' => ['required'],
            'about_img' => [
                'dimensions:min_height=251',
                'dimensions:min_width=410',
                'mimes:jpg,png,jpeg,webp',
                'max:7000',
            ],
            'about_img_alt' => ['required'],
        ];

    }

    public function attributes(): array
    {
        return [
            'title_about_en' => '"Заголовок блока о нас EN"',
            'title_about_tr' => '"Заголовок блока о нас TR"',
            'title_about_ru' => '"Заголовок блока о нас RU"',
            'description_about_en' => '"Описание блока о нас EN"',
            'description_about_tr' => '"Описание блока о нас TR"',
            'description_about_ru' => '"Описание блока о нас RU"',
            'about_img' => '"Изображение"',
            'about_img_alt' => '"Описание изображения"',
            'about_gable_id' => '"Номер страницы"',
            'about_gable_type' => '"Тип страницы"',
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
