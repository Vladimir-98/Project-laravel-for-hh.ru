<?php

namespace App\Http\Requests\Infrastructure;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class InfrastructureRequest extends FormRequest
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
            'project_id' => ['required'],
            'title_en' => ['required'],
            'title_tr' => ['required'],
            'title_ru' => ['required'],
            'description_en' => ['required'],
            'description_tr' => ['required'],
            'description_ru' => ['required'],
        ];

    }

    public function attributes(): array
    {
        return [
            'title_en' => '"Заголовок блока инфраструктуры EN"',
            'title_tr' => '"Заголовок блока инфраструктуры TR"',
            'title_ru' => '"Заголовок блока инфраструктуры RU"',
            'description_en' => '"Описание блока инфраструктуры EN"',
            'description_tr' => '"Описание блока инфраструктуры TR"',
            'description_ru' => '"Описание блока инфраструктуры RU"',
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
