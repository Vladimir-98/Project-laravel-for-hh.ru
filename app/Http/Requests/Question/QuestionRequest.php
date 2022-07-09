<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class QuestionRequest extends FormRequest
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
            'title_en' => ['required'],
            'title_tr' => ['required'],
            'title_ru' => ['required'],
            'description_en' => ['required'],
            'description_tr' => ['required'],
            'description_ru' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'title_en' => '"Заголовок вопроса EN"',
            'title_tr' => '"Заголовок вопроса TR"',
            'title_ru' => '"Заголовок вопроса RU"',
            'description_en' => '"Описание EN"',
            'description_tr' => '"Описание TR"',
            'description_ru' => '"Описание RU"',
        ];
    }

//    public function messages()
//    {
//        return [
//            'required' => ':attribute обязательно к заполнению!',
//        ];
//    }

    public function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json(array_shift($errors))
        );
    }
}
