<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use App\Models\Admin\PageImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PageImageController extends Controller
{
    const PATH = 'admin.pages.';

    const IMAGE = 'upload/pages/image/';

    public function getRequestFile($request_file): array
    {
        return [
            [
                'name' => 'image',
                'big' => ['width' => 850, 'height' => 560],
                'medium' => ['width' => 360, 'height' => 237],
                'path' => self::IMAGE,
                'file' => $request_file
            ],
        ];
    }

    /**
     * @param $id
     * @return string
     */

    public function image($id): string
    {
        $page = Page::find($id);

        return view(self::PATH . 'image', compact([
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

        if ($request->get('image')) {
            $validator = Validator::make(

                array(
                    'image' => $request->file('image'),
                    'image_alt' => $request->get('image_alt')
                ),
                array(
                    'image' => [
                        'dimensions:min_height=560',
                        'dimensions:min_width=850',
                        'mimes:jpg,png,jpeg,webp',
                        'max:7000'
                    ],
                    'image_alt' => ['required']
                ),
            );
            if ($validator->fails()) {
                return response()->json(array_values($validator->errors()->messages())[0]);
            }
        }

        /** Загрузка изображений */
        $images_save = new ImageSaver();
        $data_files = self::getRequestFile($request->file('image'));
        $page_images = $images_save->upload($data_files, $page_id);

        $page_images['page_id'] = $page_id;
        $page_images['image_alt'] = $request->get('image_alt');

        PageImage::create($page_images);

        if ($page_images) {
            return response()->json(['success' => 'Изображение успешно сохранено',]);
        } else {
            return response()->json(['Не удалось загрузить изображение!']);
        }
    }


    /**
     * Display the specified resource.
     * @param Request $request
     * @return JsonResponse
     */

    public function updateImages(Request $request): JsonResponse
    {
        $validator = '';

        if ($request->file('image')) {
            $validator = Validator::make(
                array(
                    'image' => $request->file('image'),
                    'image_alt' => $request->get('image_alt'),
                ),
                array(
                    'image' => [
                        'dimensions:min_height=560',
                        'dimensions:min_width=850',
                        'mimes:jpg,png,jpeg,webp',
                        'max:7000'
                    ],
                    'image_alt' => ['required',],
                ),
            );
            if ($validator->fails()) {
                return response()->json(array_values($validator->errors()->messages())[0]);
            }
        }

        /** Обновление изображений */

        $page_id = $request->get('page_id');

        $id = $request->get('image_id');

        $images = new ImageSaver();

        /** Обновление старого изображений */

        $page_images = PageImage::find($id);

        if ($request->file('image')) {

            $data_files = self::getRequestFile($request->file('image'));

            $images->update($data_files, $page_images);

            $page_data = $images->upload($data_files, $page_id);

        }

        $page_data['image_alt'] = $request->get('image_alt');

        $page_images->fill($page_data)->update();

        if ($page_images) {
            return response()->json(['success' => 'Изображение успешно обновленно!',]);
        } else {
            return response()->json(['Не удалось обновить изображение!']);
        }
    }
}
