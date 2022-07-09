<?php

namespace App\Http\Requests\PageReview;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PageReviewRequest extends FormRequest
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
            'title_review_en' => ['required'],
            'title_review_tr' => ['required'],
            'title_review_ru' => ['required'],
            'description_review_en' => ['required'],
            'description_review_tr' => ['required'],
            'description_review_ru' => ['required'],
            'review_gable_id' => ['required'],
            'review_gable_type' => ['required'],
        ];

    }

    public function attributes(): array
    {
        return [
            'title_review_en' => '"Заголовок блока отзывов EN"',
            'title_review_tr' => '"Заголовок блока отзывов TR"',
            'title_review_ru' => '"Заголовок блока отзывов RU"',
            'description_review_en' => '"Описание блока отзывов EN"',
            'description_review_tr' => '"Описание блока отзывов TR"',
            'description_review_ru' => '"Описание блока отзывов RU"',
            'review_gable_id' => '"Номер страницы"',
            'review_gable_type' => '"Тип страницы"',
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
