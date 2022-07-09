<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Models\Admin\Project;
use App\Models\Admin\ProjectPlan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProjectPlanController extends Controller
{
    const PATH = 'admin.projects.components.';

    const IMAGES_PLAN = 'upload/projects/plan/';

    public function getRequestFile($request_file): array
    {
        return [
            [
                'name' => 'image',
                'big' => ['width' => 850, 'height' => 560],
                'medium' => ['width' => 360, 'height' => 237],
                'path' => self::IMAGES_PLAN,
                'file' => $request_file
            ],
        ];
    }

    /**
     * @param $id
     * @return string
     */

    public function plan($id): string
    {
        $project = Project::find($id);

        return view(self::PATH . 'plan', compact([
            'project'
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

        $project_id = $request->get('project_id');

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
        $projects_images = $images_save->upload($data_files, $project_id);

        $projects_images['project_id'] = $project_id;
        $projects_images['image_alt'] = $request->get('image_alt');
        $projects_images['title_en'] = $request->get('title_en');
        $projects_images['title_tr'] = $request->get('title_tr');
        $projects_images['title_ru'] = $request->get('title_ru');

        ProjectPlan::create($projects_images);

        if ($projects_images) {
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

        $project_id = $request->get('project_id');

        $id = $request->get('plan_id');

        $images = new ImageSaver();

        /** Обновление старого изображений */

        $projects_images = ProjectPlan::find($id);

        if ($request->file('image')) {
            $data_files = self::getRequestFile($request->file('image'));

            $images->update($data_files, $projects_images);

            $projects_data = $images->upload($data_files, $project_id);

        }

        $projects_data['project_id'] = $project_id;
        $projects_data['image_alt'] = $request->get('image_alt');
        $projects_data['title_en'] = $request->get('title_en');
        $projects_data['title_tr'] = $request->get('title_tr');
        $projects_data['title_ru'] = $request->get('title_ru');

//        if ($request->get('status') == '1') {
//            $projects_data['status'] = $request->get('status');
//        } else {
//            $projects_data['status'] = 0;
//        }

        $projects_images->fill($projects_data)->update();


        if ($projects_images) {
            return response()->json(['success' => 'Изображения успешно обновленны!',]);
        } else {
            return response()->json(['Не удалось обновить изображения!']);
        }
    }

    public function planDelete(Request $request): JsonResponse
    {
        $id = $request->get('id');

        $project_plans = ProjectPlan::find($id);

        $images = new ImageSaver();
        $data_files = self::getRequestFile($request);

        unlink('upload/projects/plan/' . $project_plans['image']);
        unlink('upload/projects/plan/' . $project_plans['image_medium']);
        $query = ProjectPlan::destroy($id);


        if (!$query) {
            return response()->json(['Не удалось удалить план!']);
        }

        return response()->json(['success' => 'План успешно удалённ!', 'component' => 'plan']);
    }
}
