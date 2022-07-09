<?php

namespace App\Http\Requests\Meta;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MetaRequest extends FormRequest
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
//            'title_meta_en' => ['required', 'max:80', 'min:30'],
//            'title_meta_tr' => ['required', 'max:80', 'min:30'],
//            'title_meta_ru' => ['required', 'max:80', 'min:30'],
            'description_meta_en' => ['required', 'max:300'],
            'description_meta_tr' => ['required', 'max:300'],
            'description_meta_ru' => ['required', 'max:300'],
//            'canonical' => ['required'],
            'meta_gable_id' => ['required'],
            'meta_gable_type' => ['required'],
        ];

    }

    public function attributes(): array
    {
        return [
//            'title_meta_en' => '"Заголовок мета тега EN"',
//            'title_meta_tr' => '"Заголовок мета тега TR"',
//            'title_meta_ru' => '"Заголовок мета тега RU"',
            'description_meta_en' => '"Описание мета тега EN"',
            'description_meta_tr' => '"Описание мета тега TR"',
            'description_meta_ru' => '"Описание мета тега RU"',
            'meta_gable_id' => '"Номер страницы"',
            'meta_gable_type' => '"Тип страницы"',
//            'canonical' => '"Каноническое название"',
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
