<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use App\Models\Admin\PageSlider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PageSliderController extends Controller
{
    const PATH = 'admin.pages.';

    const IMAGES_SLIDER = 'upload/pages/slider/';

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

    public function pageSlider($id): string
    {
        $page = Page::find($id);

        return view(self::PATH . 'slider', compact([
            'page'
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

        $page_id = $request->get('page_id');

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
            $page_images = $images_save->upload($data_files, $page_id);

            $page_images['page_id'] = $page_id;
            $page_images['image_alt'] = $request->get('image_alt_' . $i);
            PageSlider::create($page_images);
        }

        if ($page_images) {
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

        $page_id = $request->get('page_id');

        for ($i = 1; $i <= $count_images; $i++) {

            $id = $request->get('id_' . $i . '');

            $images = new ImageSaver();

            if ($id) {

                /** Обновление старого изображений */

                $page_images = PageSlider::find($id);

                if ($request->has('image_' . $i)) {
                    $data_files = self::getRequestFile($request->file('image_' . $i));
                    $images->update($data_files, $page_images);
                    $page_data = $images->upload($data_files, $page_id);

                    $page_data['page_id'] = $page_id;
                    $page_data['image_alt'] = $request->get('image_alt_' . $i);
                    $page_images->fill($page_data)->update();
                } else {
                    $page_images->image_alt = $request->get('image_alt_' . $i);
                    $page_images['page_id'] = $page_id;
                    $page_images->save();
                }
            } else {
                if ($request->has('image_' . $i)) {

                    /** Загрузка добавленного изображения */
                    $data_files = self::getRequestFile($request->file('image_' . $i . ''));
                    $page_images = $images->upload($data_files, $page_id);
                    $page_images['page_id'] = $page_id;
                    $page_images['image_alt'] = $request->get('image_alt_' . $i);
                    PageSlider::create($page_images);

                }
            }

        }

        if ($page_images) {
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
        $page_slider = PageSlider::find($id);
        if ($images->delete($data_files, $page_slider)) {
            $query = PageSlider::destroy($id);
        }

        if (!$query) {

            return response()->json(['Не удалось удалить изображения!']);
        }

        return response()->json(['success' => 'Изображение успешно удаленно!']);
    }
}
