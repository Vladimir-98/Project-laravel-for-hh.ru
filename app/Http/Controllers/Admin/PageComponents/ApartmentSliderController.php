<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Models\Admin\Apartments;
use App\Models\Admin\ApartmentsSlider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ApartmentSliderController extends Controller
{
    const PATH = 'admin.apartments.components.';

    const IMAGES_SLIDER = 'upload/apartments/slider/';

    public function getRequestFile($request_file): array
    {
        return [
            [
                'name' => 'image',
                'big' => ['width' => 852, 'height' => 568],
                'medium' => ['width' => 370, 'height' => 247],
                'small' => ['width' => 120, 'height' => 80],
                'path' => self::IMAGES_SLIDER,
                'file' => $request_file
            ],
        ];
    }

    /**
     * @param $id
     * @return string
     */

    public function slider($id): string
    {
        $apartment = Apartments::find($id);

        return view(self::PATH . 'swiper', compact([
            'apartment'
        ]))->render();
    }


    /**
     * Display the specified resource.
     * @param Request $request
     * @return JsonResponse
     */

    public function addImages(Request $request): JsonResponse
    {
        $validator = '';

        $apartment_id = $request->get('apartment_id');

        $count_images = count($request->files);

        if ($count_images === 0) {
            return response()->json(['Не чего загружать!']);
        }

        for ($i = 1; $i <= $count_images; $i++) {


            $validator = Validator::make(

                array(
                    'image_' . $i . '' => $request->file('image_' . $i . ''),
                    'image_alt_' . $i . '' => $request->get('image_alt_' . $i . '')
                ),
                array(
                    'image_' . $i . '' => [
                        'required',
                        'dimensions:min_height=568',
                        'dimensions:min_width=852',
                        'mimes:jpg,png,jpeg,webp',
                        'max:7000'
                    ],
                    'image_alt_' . $i . '' => ['required']
                ),
            );
            if ($validator->fails()) {
                return response()->json(array_values($validator->errors()->messages())[0]);
            }
        }


        for ($i = 1; $i <= $count_images; $i++) {


            /** Загрузка изображений */
            $images_save = new ImageSaver();
            $data_files = self::getRequestFile($request->file('image_' . $i . ''));
            $apartments_images = $images_save->upload($data_files, $apartment_id);

            $apartments_images['apartment_id'] = $apartment_id;
            $apartments_images['image_alt'] = $request->get('image_alt_' . $i);
            ApartmentsSlider::create($apartments_images);
        }

        if ($apartments_images) {
            return response()->json(['success' => 'Изображения успешно сохранены',]);
        } else {
            return response()->json(['Не удалось загрузить изображения!']);
        }
    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @return JsonResponse
     */

    public function updateImages(Request $request): JsonResponse
    {
        $keys = collect($request->all())->keys();

        /** Валидация изображений */

        $validator = '';

        $count_images = count($keys);

        for ($i = 1; $i <= $count_images; $i++) {

            /** Валидация старого изображения */

            if ($request->has('id_' . $i . '')) {

                if ($request->has('image_' . $i . '')) {
                    $validator = Validator::make(
                        array(
                            'image_' . $i . '' => $request->file('image_' . $i . ''),
                            'image_alt_' . $i . '' => $request->get('image_alt_' . $i . ''),
                        ),
                        array(
                            'image_' . $i . '' => [
                                'required',
                                'dimensions:min_height=568',
                                'dimensions:min_width=852',
                                'mimes:jpg,png,jpeg,webp',
                                'max:7000'
                            ],
                            'image_alt_' . $i . '' => ['required',],
                        ),
                    );

                } else {
                    $validator = Validator::make(
                        array(
                            'image_alt_' . $i . '' => $request->get('image_alt_' . $i . ''),
                        ),
                        array(
                            'image_alt_' . $i . '' => ['required',],
                        ),
                    );

                }

            } else {

                /** Валидация добавленного изображения */

                if ($request->has('image_' . $i . '')) {
                    $validator = Validator::make(

                        array(
                            'image_' . $i . '' => $request->file('image_' . $i . ''),
                            'image_alt_' . $i . '' => $request->get('image_alt_' . $i . ''),
                        ),

                        array(
                            'image_' . $i . '' => [
                                'required',
                                'dimensions:min_height=568',
                                'dimensions:min_width=852',
                                'mimes:jpg,png,jpeg,webp',
                                'max:7000'
                            ],
                            'image_alt_' . $i . '' => ['required',],
                        ),
                    );

                }
            }
            if ($validator->fails()) {
                return response()->json(array_values($validator->errors()->messages())[0]);
            }
        }

        /** Обновление изображений */

        $apartment_id = $request->get('apartment_id');

        for ($i = 1; $i <= $count_images; $i++) {

            $id = $request->get('id_' . $i . '');

            $images = new ImageSaver();

            if ($id) {

                /** Обновление старого изображений */

                $apartments_images = ApartmentsSlider::find($id);

                if ($request->has('image_' . $i)) {
                    $data_files = self::getRequestFile($request->file('image_' . $i));
                    $images->update($data_files, $apartments_images);
                    $apartments_data = $images->upload($data_files, $apartment_id);

                    $apartments_data['apartment_id'] = $apartment_id;
                    $apartments_data['image_alt'] = $request->get('image_alt_' . $i);
                    $apartments_images->fill($apartments_data)->update();
                } else {
                    $apartments_images->image_alt = $request->get('image_alt_' . $i);
                    $apartments_images->save();
                }
            } else {
                if ($request->has('image_' . $i)) {

                    /** Загрузка добавленного изображения */
                    $data_files = self::getRequestFile($request->file('image_' . $i . ''));
                    $apartments_images = $images->upload($data_files, $apartment_id);
                    $apartments_images['apartment_id'] = $apartment_id;
                    $apartments_images['image_alt'] = $request->get('image_alt_' . $i);
                    ApartmentsSlider::create($apartments_images);

                }
            }

        }

        if ($apartments_images) {
            return response()->json(['success' => 'Изображения успешно обновленны!',]);
        } else {
            return response()->json(['Не удалось обновить изображения!']);
        }
    }


    /**
     * Display the specified resource.
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */

    public function deleteImage(Request $request, $id): JsonResponse
    {
        $query = false;

        /** Удаление изображений */
        $images = new ImageSaver();
        $data_files = self::getRequestFile($request);
        $apartment_slide = ApartmentsSlider::find($id);
        if ($images->delete($data_files, $apartment_slide)) {
            $query = ApartmentsSlider::destroy($id);
        }

        if (!$query) {

            return response()->json(['Не удалось удалить изображения!']);
        }

        return response()->json(['success' => 'Изображение успешно удаленно!']);
    }
}
