<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;

use App\Models\Admin\Project;
use App\Models\Admin\ProjectProgressTitle;
use App\Models\Admin\ProjectsProgress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProjectProgressController extends Controller
{
    const PATH = 'admin.projects.components.';

    const IMAGES_PROGRESS = 'upload/projects/progress/';

    public function getRequestFile($request_file): array
    {
        return [
            [
                'name' => 'image',
                'big' => ['width' => 380, 'height' => 185],
                'path' => self::IMAGES_PROGRESS,
                'file' => $request_file
            ],
        ];
    }

    /**
     * @param $id
     * @return string
     */

    public function progress($id): string
    {
        $project = Project::find($id);

        return view(self::PATH . 'progress', compact([
            'project'
        ]))->render();
    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @return JsonResponse
     */

    public function addProgressImages(Request $request): JsonResponse
    {
        $validator = '';

        $project_id = $request->get('project_id');

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
                        'dimensions:min_height=185',
                        'dimensions:min_width=380',
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
            $projects_images = $images_save->upload($data_files, $project_id);

            $projects_images['project_id'] = $project_id;
            $projects_images['image_alt'] = $request->get('image_alt_' . $i);
            $projects_images['title_img_en'] = $request->get('title_img_en_' . $i);
            $projects_images['title_img_tr'] = $request->get('title_img_tr_' . $i);
            $projects_images['title_img_ru'] = $request->get('title_img_ru_' . $i);
            $projects_images['date'] = $request->get('date_' . $i);
            ProjectsProgress::create($projects_images);

        }

        ProjectProgressTitle::create($request->all());

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

    public function updateProgressImages(Request $request): JsonResponse
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
                                'dimensions:min_height=185',
                                'dimensions:min_width=380',
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
                                'dimensions:min_height=185',
                                'dimensions:min_width=380',
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

        $project_id = $request->get('project_id');

        for ($i = 1; $i <= $count_images; $i++) {

            $id = $request->get('id_' . $i . '');

            $images = new ImageSaver();

            if ($id) {

                /** Обновление старого изображений */

                $projects_images = ProjectsProgress::find($id);


                if ($request->has('image_' . $i)) {
                    $data_files = self::getRequestFile($request->file('image_' . $i));
                    $images->update($data_files, $projects_images);
                    $projects_data = $images->upload($data_files, $project_id);

                    $projects_data['project_id'] = $project_id;
                    $projects_data['image_alt'] = $request->get('image_alt_' . $i);
                    $projects_data['title_img_en'] = $request->get('title_img_en_' . $i);
                    $projects_data['title_img_tr'] = $request->get('title_img_tr_' . $i);
                    $projects_data['title_img_ru'] = $request->get('title_img_ru_' . $i);
                    $projects_data['date'] = $request->get('date_' . $i);
                    $projects_images->fill($projects_data)->update();

                } else {
                    $projects_images->image_alt = $request->get('image_alt_' . $i);
                    $projects_images->title_img_en = $request->get('title_img_en_' . $i);
                    $projects_images->title_img_tr = $request->get('title_img_tr_' . $i);
                    $projects_images->title_img_ru = $request->get('title_img_ru_' . $i);
                    $projects_images->date = $request->get('date_' . $i);
                    $projects_images->save();
                }
            } else {
                if ($request->has('image_' . $i)) {

                    /** Загрузка добавленного изображения */
                    $data_files = self::getRequestFile($request->file('image_' . $i . ''));
                    $projects_images = $images->upload($data_files, $project_id);
                    $projects_images['project_id'] = $project_id;
                    $projects_images['image_alt'] = $request->get('image_alt_' . $i);
                    $projects_images['title_img_en'] = $request->get('title_img_en_' . $i);
                    $projects_images['title_img_tr'] = $request->get('title_img_tr_' . $i);
                    $projects_images['title_img_ru'] = $request->get('title_img_ru_' . $i);
                    $projects_images['date'] = $request->get('date_' . $i);
                    ProjectsProgress::create($projects_images);

                }
            }

        }

        $title_id = $request->get('title_id');

        $progress_titles = ProjectProgressTitle::find($title_id);

        if ($progress_titles) {
            $progress_titles->fill($request->all())->update();
        } else {
            ProjectProgressTitle::create($request->all());
        }

        if ($projects_images) {
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

    public function deleteProgressImage(Request $request, $id): JsonResponse
    {
        $query = false;

        /** Удаление изображений */
        $images = new ImageSaver();
        $data_files = self::getRequestFile($request);
        $project_slide = ProjectsProgress::find($id);
        if ($images->delete($data_files, $project_slide)) {
            $query = ProjectsProgress::destroy($id);
        }

        if (!$query) {

            return response()->json(['Не удалось удалить изображения!']);
        }

        return response()->json(['success' => 'Изображение успешно удаленно!']);
    }
}
