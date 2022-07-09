<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\About\AboutRequest;
use App\Models\Admin\About;
use App\Models\Admin\Page;
use Illuminate\Http\JsonResponse;

class AboutController extends Controller
{
    const PATH = 'admin.pages.';

    const IMAGES_about = 'upload/pages/about/';

    public function getRequestFile($request): array
    {
        return [
            ['name' => 'about_img', 'big' => ['width' => 410, 'height' => 251], 'medium' => ['width' => 382, 'height' => 235], 'path' => self::IMAGES_about, 'file' => $request->file('about_img')],
        ];
    }

    /**
     * @param $id
     * @return string
     */

    public function about($id): string
    {
        $page = Page::find($id);

        if ( !$page ) { abort(404); }

        return view(self::PATH . 'about', compact([
            'page'
        ]))->render();

    }

    /**
     * @param AboutRequest $request
     * @return JsonResponse
     */

    public function aboutUpdate(AboutRequest $request): JsonResponse
    {

        $page_id = $request->get('about_gable_id');
        $page_type = $request->get('about_gable_type');
        $about_table = $request->all();

        /** Обновление изображений */
        $images = new ImageSaver();
        $data_files = self::getRequestFile($request);
        $about_images = About::where('about_gable_id', $page_id)->where('about_gable_type', $page_type)->first();

        if ($about_images !== null) {

            $images->update($data_files, $about_images);

            $about_img_data = $images->upload($data_files, $page_id);
            if ($about_img_data) {
                $about_table['about_img'] = $about_img_data['about_img'];
                $about_table['about_img_medium'] = $about_img_data['about_img_medium'];
            }

            $query = $about_images->fill($about_table)->update();

        } else {
            $about_img_data = $images->upload($data_files, $page_id);
            $about_table['about_img'] = $about_img_data['about_img'];
            $about_table['about_img_medium'] = $about_img_data['about_img_medium'];
            $about_table['about_gable_id'] = $page_id;
            $about_table['about_gable_type'] = $page_type;

            $query = About::create($about_table);
        }

        $error = 'Не удалось обновить блок о нас!';
        $success = 'Блок о нас успешно обновлён!';

        if ( $page_id == 9 ) {
            $error = 'Не удалось обновить описание страницы дизайн!';
            $success = 'Описание страницы дизайн успешно обновлено!';
        }

        if (!$query) {
            return response()->json([$error]);
        }

        return response()->json(['success' => $success]);

    }
}
