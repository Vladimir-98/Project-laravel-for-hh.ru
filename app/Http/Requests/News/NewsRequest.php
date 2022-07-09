<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class NewsRequest extends FormRequest
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
            'title_en' => ['required'],
            'title_tr' => ['required'],
            'title_ru' => ['required'],
            'description_en' => ['required'],
            'description_tr' => ['required'],
            'description_ru' => ['required'],
            'post' => [
                'dimensions:min_height=160',
                'dimensions:min_width=240',
                'mimes:jpg,png,jpeg,webp',
                'max:7000',
            ],
            'post_alt' => ['required'],
        ];

        if (empty($this->id)) {
            array_unshift($rules_arr['post'], 'required');
        }
        return $rules_arr;

    }

    public function attributes()
    {
        return [
            'title_en' => '"Заголовок новости EN"',
            'title_tr' => '"Заголовок новости TR"',
            'title_ru' => '"Заголовок новости RU"',
            'description_en' => '"Описание EN"',
            'description_tr' => '"Описание TR"',
            'description_ru' => '"Описание RU"',
            'post' => '"Изображение"',
            'post_alt' => '"Описание изображения"',
            'youtube' => '"Ссылка на ютуб"',
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
