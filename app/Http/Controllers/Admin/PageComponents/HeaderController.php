<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\Header\HeaderRequest;
use App\Models\Admin\Header;
use App\Models\Admin\Page;
use Illuminate\Http\JsonResponse;


class HeaderController extends Controller
{
    const PATH = 'admin.pages.';

    const IMAGES_HEADER = 'upload/pages/header/';

    public function getRequestFile($request): array
    {
        return [
            ['name' => 'header_img', 'big' => ['width' => 1280, 'height' => 485], 'medium' => ['width' => 435, 'height' => 583], 'path' => self::IMAGES_HEADER, 'file' => $request->file('header_img')],
        ];
    }

    /**
     * @param $id
     * @return string
     */

    public function header($id): string
    {
        $page = Page::find($id);

        if ( !$page ) { abort(404); }

        return view(self::PATH . 'header', compact([
            'page'
        ]))->render();

    }

    /**
     * @param HeaderRequest $request
     * @return JsonResponse
     */

    public function headerUpdate(HeaderRequest $request): JsonResponse
    {

        $page_id = $request->get('header_gable_id');
        $page_type = $request->get('header_gable_type');
        $header_table = $request->all();

        /** Обновление изображений */
        $images = new ImageSaver();
        $data_files = self::getRequestFile($request);
        $header_images = Header::where('header_gable_id', $page_id)->where('header_gable_type', $page_type)->first();

        if ($header_images !== null) {

            $images->update($data_files, $header_images);

            $header_img_data = $images->upload($data_files, $page_id);
            if ($header_img_data) {
                $header_table['header_img'] = $header_img_data['header_img'];
                $header_table['header_img_medium'] = $header_img_data['header_img_medium'];
            }

            $query = $header_images->fill($header_table)->update();

        } else {
            $header_img_data = $images->upload($data_files, $page_id);
            $header_table['header_img'] = $header_img_data['header_img'];
            $header_table['header_img_medium'] = $header_img_data['header_img_medium'];
            $header_table['header_gable_id'] = $page_id;
            $header_table['header_gable_type'] = $page_type;

            $query = Header::create($header_table);
        }


        if (!$query) {
            return response()->json(['Не удалось обновить шапку!']);
        }

        return response()->json(['success' => 'Шапка успешно обновлена!']);

    }
}
