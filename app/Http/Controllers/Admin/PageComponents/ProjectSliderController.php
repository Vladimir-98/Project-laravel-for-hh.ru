<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;

use App\Models\Admin\Project;
use App\Models\Admin\ProjectsSlider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProjectSliderController extends Controller
{
    const PATH = 'admin.projects.components.';

    const IMAGES_SLIDER = 'upload/projects/slider/';

    public function getRequestFile($request_file): array
    {
        return [
            [
                'name' => 'image',
                'big' => ['width' => 970, 'height' => 455],
                'medium' => ['width' => 385, 'height' => 437],
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
        $project = Project::find($id);

        return view(self::PATH . 'swiper', compact([
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
                        'dimensions:min_height=455',
                        'dimensions:min_width=970',
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
            $projects_images['title_en'] = $request->get('title_en_' . $i);
            $projects_images['title_tr'] = $request->get('title_tr_' . $i);
            $projects_images['title_ru'] = $request->get('title_ru_' . $i);
            $projects_images['description_en'] = $request->get('description_en_' . $i);
            $projects_images['description_tr'] = $request->get('description_tr_' . $i);
            $projects_images['description_ru'] = $request->get('description_ru_' . $i);

            ProjectsSlider::create($projects_images);
        }

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
                                'dimensions:min_height=455',
                                'dimensions:min_width=970',
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
                                'dimensions:min_height=455',
                                'dimensions:min_width=970',
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

                $projects_images = ProjectsSlider::find($id);

                if ($request->has('image_' . $i)) {
                    $data_files = self::getRequestFile($request->file('image_' . $i));
                    $images->update($data_files, $projects_images);
                    $projects_data = $images->upload($data_files, $project_id);

                    $projects_data['project_id'] = $project_id;
                    $projects_data['image_alt'] = $request->get('image_alt_' . $i);
                    $projects_data['title_en'] = $request->get('title_en_' . $i);
                    $projects_data['title_tr'] = $request->get('title_tr_' . $i);
                    $projects_data['title_ru'] = $request->get('title_ru_' . $i);
                    $projects_data['description_en'] = $request->get('description_en_' . $i);
                    $projects_data['description_tr'] = $request->get('description_tr_' . $i);
                    $projects_data['description_ru'] = $request->get('description_ru_' . $i);
                    $projects_images->fill($projects_data)->update();
                } else {
                    $projects_images->image_alt = $request->get('image_alt_' . $i);
                    $projects_images->title_en = $request->get('title_en_' . $i);
                    $projects_images->title_tr = $request->get('title_tr_' . $i);
                    $projects_images->title_ru = $request->get('title_ru_' . $i);
                    $projects_images->description_en = $request->get('description_en_' . $i);
                    $projects_images->description_tr = $request->get('description_tr_' . $i);
                    $projects_images->description_ru = $request->get('description_ru_' . $i);
                    $projects_images->save();
                }
            } else {
                if ($request->has('image_' . $i)) {

                    /** Загрузка добавленного изображения */
                    $data_files = self::getRequestFile($request->file('image_' . $i . ''));
                    $projects_images = $images->upload($data_files, $project_id);
                    $projects_images['project_id'] = $project_id;
                    $projects_images['image_alt'] = $request->get('image_alt_' . $i);
                    $projects_images['title_en'] = $request->get('title_en_' . $i);
                    $projects_images['title_tr'] = $request->get('title_tr_' . $i);
                    $projects_images['title_ru'] = $request->get('title_ru_' . $i);
                    $projects_images['description_en'] = $request->get('description_en_' . $i);
                    $projects_images['description_tr'] = $request->get('description_tr_' . $i);
                    $projects_images['description_ru'] = $request->get('description_ru_' . $i);
                    ProjectsSlider::create($projects_images);

                }
            }

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

    public function deleteImage(Request $request, $id): JsonResponse
    {
        $query = false;

        /** Удаление изображений */
        $images = new ImageSaver();
        $data_files = self::getRequestFile($request);
        $project_slide = ProjectsSlider::find($id);
        if ($images->delete($data_files, $project_slide)) {
            $query = ProjectsSlider::destroy($id);
        }

        if (!$query) {

            return response()->json(['Не удалось удалить изображения!']);
        }

        return response()->json(['success' => 'Изображение успешно удаленно!']);
    }
}
