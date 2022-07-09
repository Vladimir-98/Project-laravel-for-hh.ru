<?php

namespace App\Http\Requests\Description;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DescriptionRequest extends FormRequest
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
            'title_en' => ['required'],
            'title_tr' => ['required'],
            'title_ru' => ['required'],
            'description_en' => ['required'],
            'description_tr' => ['required'],
            'description_ru' => ['required'],
            'description_gable_id' => ['required'],
            'description_gable_type' => ['required'],
        ];

    }

    public function attributes(): array
    {
        return [
            'title_en' => '"Заголовок блока о нас EN"',
            'title_tr' => '"Заголовок блока о нас TR"',
            'title_ru' => '"Заголовок блока о нас RU"',
            'description_en' => '"Описание блока о нас EN"',
            'description_tr' => '"Описание блока о нас TR"',
            'description_ru' => '"Описание блока о нас RU"',
            'description_gable_id' => '"Номер страницы"',
            'description_gable_type' => '"Тип страницы"',
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
