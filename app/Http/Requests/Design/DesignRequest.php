<?php

namespace App\Http\Requests\Design;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DesignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
        $rules_arr = [
            'title_design_en' => ['required'],
            'title_design_tr' => ['required'],
            'title_design_ru' => ['required'],

            'design_img_one' => [
                'dimensions:min_height=436',
                'dimensions:min_width=352',
                'mimes:jpg,png,jpeg,webp',
                'max:7000',
                ],
            'design_img_one_alt' => ['required'],

            'design_img_two' => [
                'dimensions:min_height=219',
                'dimensions:min_width=372',
                'mimes:jpg,png,jpeg,webp',
                'max:7000',
                ],
            'design_img_two_alt' => ['required'],

            'design_img_three' => [
                'dimensions:min_height=205',
                'dimensions:min_width=313',
                'mimes:jpg,png,jpeg,webp',
                'max:7000',
                ],
            'design_img_three_alt' => ['required'],

            'design_img_four' => [
                'dimensions:min_height=216',
                'dimensions:min_width=333',
                'mimes:jpg,png,jpeg,webp',
                'max:7000',
                ],
            'design_img_four_alt' => ['required'],

            'design_img_five' => [
                'dimensions:min_height=315',
                'dimensions:min_width=254',
                'mimes:jpg,png,jpeg,webp',
                'max:7000',
                ],
            'design_img_five_alt' => ['required'],

            'design_gable_id' => ['required'],
            'design_gable_type' => ['required'],
        ];

        if (empty($this->design_gable_id)) {
            array_unshift($rules_arr['design_img_one'], 'required');
            array_unshift($rules_arr['design_img_two'], 'required');
            array_unshift($rules_arr['design_img_three'], 'required');
            array_unshift($rules_arr['design_img_four'], 'required');
            array_unshift($rules_arr['design_img_five'], 'required');
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
