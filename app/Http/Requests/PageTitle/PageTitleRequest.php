<?php

namespace App\Http\Requests\PageTitle;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PageTitleRequest extends FormRequest
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
        $page_arr = [
            'page_title_one_en' => ['max:80', 'required'],
            'page_title_one_tr' => ['max:80', 'required'],
            'page_title_one_ru' => ['max:80', 'required'],
            'page_title_two_en' => ['max:50'],
            'page_title_two_tr' => ['max:50'],
            'page_title_two_ru' => ['max:50'],
            'page_title_three_en' => ['max:50'],
            'page_title_three_tr' => ['max:50'],
            'page_title_three_ru' => ['max:50'],
            'page_title_four_en' => ['max:50'],
            'page_title_four_tr' => ['max:50'],
            'page_title_four_ru' => ['max:50'],
//            'page_title_five_en' => ['required'],
//            'page_title_five_tr' => ['required'],
//            'page_title_five_ru' => ['required'],
            'page_title_gable_id' => ['required'],
            'page_title_gable_type' => ['required'],
        ];


        if (isset($this->page_title_gable_id) && $this->page_title_gable_id == '1') {
            array_unshift($page_arr['page_title_two_en'], 'required');
            array_unshift($page_arr['page_title_two_tr'], 'required');
            array_unshift($page_arr['page_title_two_ru'], 'required');
            array_unshift($page_arr['page_title_three_en'], 'required');
            array_unshift($page_arr['page_title_three_tr'], 'required');
            array_unshift($page_arr['page_title_three_ru'], 'required');
            array_unshift($page_arr['page_title_four_en'], 'required');
            array_unshift($page_arr['page_title_four_tr'], 'required');
            array_unshift($page_arr['page_title_four_ru'], 'required');
        }
        return $page_arr;
    }

    public function attributes(): array
    {
        return [
            'page_title_one_en' => '"Заголовок реализованные проекты EN"',
            'page_title_one_tr' => '"Заголовок реализованные проекты TR"',
            'page_title_one_ru' => '"Заголовок реализованные проекты RU"',
            'page_title_two_en' => '"Заголовок строящиеся проекты EN"',
            'page_title_two_tr' => '"Заголовок строящиеся проекты TR"',
            'page_title_two_ru' => '"Заголовок строящиеся проекты RU"',
            'page_title_three_en' => '"Заголовок квартир EN"',
            'page_title_three_tr' => '"Заголовок квартир TR"',
            'page_title_three_ru' => '"Заголовок квартир RU"',
            'page_title_four_en' => '"Заголовок вопросов"',
            'page_title_four_tr' => '"Заголовок вопросов"',
            'page_title_four_ru' => '"Заголовок вопросов"',
//            'page_title_five_en' => '"Заголовок проекты"',
//            'page_title_five_tr' => '"Заголовок проекты"',
//            'page_title_five_ru' => '"Заголовок проекты"',
            'page_title_gable_id' => '"Номер страницы"',
            'page_title_gable_type' => '"Тип страницы"',
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
