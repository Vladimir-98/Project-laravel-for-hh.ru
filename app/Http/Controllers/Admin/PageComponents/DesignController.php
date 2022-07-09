<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\Design\DesignRequest;
use App\Models\Admin\Design;
use App\Models\Admin\Page;
use Illuminate\Http\JsonResponse;


class DesignController extends Controller
{
    const PATH = 'admin.pages.';

    const IMAGES_DESIGN = 'upload/pages/design/';

    public function getRequestFile($request): array
    {
        return [
            ['name' => 'design_img_one', 'big' => ['width' => 352, 'height' => 436], 'path' => self::IMAGES_DESIGN, 'file' => $request->file('design_img_one')],
            ['name' => 'design_img_two', 'big' => ['width' => 372, 'height' => 219], 'path' => self::IMAGES_DESIGN, 'file' => $request->file('design_img_two')],
            ['name' => 'design_img_three', 'big' => ['width' => 313, 'height' => 205], 'path' => self::IMAGES_DESIGN, 'file' => $request->file('design_img_three')],
            ['name' => 'design_img_four', 'big' => ['width' => 333, 'height' => 216], 'path' => self::IMAGES_DESIGN, 'file' => $request->file('design_img_four')],
            ['name' => 'design_img_five', 'big' => ['width' => 254, 'height' => 315], 'path' => self::IMAGES_DESIGN, 'file' => $request->file('design_img_five')],
        ];
    }

    /**
     * @param $id
     * @return string
     */

    public function design($id): string
    {
        $page = Page::find($id);

        if ( !$page ) { abort(404); }

        return view(self::PATH . 'design', compact([
            'page'
        ]))->render();

    }

    /**
     * @param DesignRequest $request
     * @return JsonResponse
     */

    public function designUpdate(DesignRequest $request): JsonResponse
    {

        $page_id = $request->get('design_gable_id');
        $page_type = $request->get('design_gable_type');
        $design_table = $request->all();

        /** Обновление изображений */
        $images = new ImageSaver();
        $data_files = self::getRequestFile($request);
        $design_images = Design::where('design_gable_id', $page_id)->where('design_gable_type', $page_type)->first();

        if ($design_images !== null) {

            $images->update($data_files, $design_images);

            $design_img_data = $images->upload($data_files, $page_id);

            if ($design_img_data) {
                foreach ($design_img_data as $key => $value) {
                    $design_table[$key] = $value;
                }
            }

            $query = $design_images->fill($design_table)->update();

        } else {

            $design_img_data = $images->upload($data_files, $page_id);
            $design_table['design_img_one'] = $design_img_data['design_img_one'];
            $design_table['design_img_two'] = $design_img_data['design_img_two'];
            $design_table['design_img_three'] = $design_img_data['design_img_three'];
            $design_table['design_img_four'] = $design_img_data['design_img_four'];
            $design_table['design_img_five'] = $design_img_data['design_img_five'];

            $query = Design::create($design_table);
        }


        if (!$query) {
            return response()->json(['Не удалось обновить блок дизайна!']);
        }

        return response()->json(['success' => 'Блок дизайна успешно обновлена!']);

    }
}
