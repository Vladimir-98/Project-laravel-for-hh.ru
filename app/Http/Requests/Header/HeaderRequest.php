<?php

namespace App\Http\Requests\Header;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class HeaderRequest extends FormRequest
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
            'title_header_en' => ['required', 'max:50'],
            'title_header_tr' => ['required', 'max:50'],
            'title_header_ru' => ['required', 'max:50'],
            'description_header_en' => ['required', 'max:300'],
            'description_header_tr' => ['required', 'max:300'],
            'description_header_ru' => ['required', 'max:300'],
            'header_gable_id' => ['required'],
            'header_gable_type' => ['required'],
            'header_img' => [
                'dimensions:min_height=485',
                'dimensions:min_width=1280',
                'mimes:jpg,png,jpeg,webp',
                'max:7000',
            ],
            'header_img_alt' => ['required'],
        ];

    }

    public function attributes(): array
    {
        return [
            'title_header_en' => '"Заголовок шапки EN"',
            'title_header_tr' => '"Заголовок шапки TR"',
            'title_header_ru' => '"Заголовок шапки RU"',
            'description_header_en' => '"Описание шапки EN"',
            'description_header_tr' => '"Описание шапки TR"',
            'description_header_ru' => '"Описание шапки RU"',
            'header_img' => '"Изображение"',
            'header_img_alt' => '"Описание изображения"',
            'header_gable_id' => '"Номер страницы"',
            'header_gable_type' => '"Тип страницы"',
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
