<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;

use App\Models\Admin\Project;
use App\Models\Admin\ProjectLayoutDescription;
use App\Models\Admin\ProjectsLayoutSlider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LayoutsSliderController extends Controller
{
    const PATH = 'admin.projects.components.';

    const IMAGES_LAYOUT = 'upload/projects/layouts/';

    public function getRequestFile($request_file): array
    {
        return [
            [
                'name' => 'image',
                'big' => ['width' => 260, 'height' => 205],
                'path' => self::IMAGES_LAYOUT,
                'file' => $request_file
            ],
        ];
    }

    /**
     * @param $id
     * @return string
     */

    public function layouts($id): string
    {
        $project = Project::find($id);


        return view(self::PATH . 'layouts-slider', compact([
            'project'
        ]))->render();
    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @return JsonResponse
     */

    public function addLayouts(Request $request): JsonResponse
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
                        'dimensions:min_height=205',
                        'dimensions:min_width=260',
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
            $layout_images = $images_save->upload($data_files, $project_id);

            $layout_images['project_id'] = $project_id;
            $layout_images['image_alt'] = $request->get('image_alt_' . $i);
            $layout_images['layout'] = $request->get('layout_' . $i);
            $layout_images['balcony'] = $request->get('balcony_' . $i);
            $layout_images['quadrature'] = $request->get('quadrature_' . $i);
            $layout_images['bathroom'] = $request->get('bathroom_' . $i);

            ProjectsLayoutSlider::create($layout_images);
        }

        ProjectLayoutDescription::create($request->all());

        if ($layout_images) {
            return response()->json(['success' => 'Данные успешно сохранены',]);
        } else {
            return response()->json(['Не удалось загрузить данные!']);
        }
    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @return JsonResponse
     */

    public function updateLayouts(Request $request): JsonResponse
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
                                'dimensions:min_height=205',
                                'dimensions:min_width=260',
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
                                'dimensions:min_height=205',
                                'dimensions:min_width=260',
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

                $layouts_images = ProjectsLayoutSlider::find($id);

                if ($request->has('image_' . $i)) {
                    $data_files = self::getRequestFile($request->file('image_' . $i));
                    $images->update($data_files, $layouts_images);
                    $layouts_data = $images->upload($data_files, $project_id);

                    $layouts_data['project_id'] = $project_id;
                    $layouts_data['image_alt'] = $request->get('image_alt_' . $i);
                    $layouts_data['layout'] = $request->get('layout_' . $i);
                    $layouts_data['balcony'] = $request->get('balcony_' . $i);
                    $layouts_data['quadrature'] = $request->get('quadrature_' . $i);
                    $layouts_data['bathroom'] = $request->get('bathroom_' . $i);
                    $layouts_images->fill($layouts_data)->update();

                } else {
                    $layouts_images->image_alt = $request->get('image_alt_' . $i);
                    $layouts_images->layout = $request->get('layout_' . $i);
                    $layouts_images->balcony = $request->get('balcony_' . $i);
                    $layouts_images->quadrature = $request->get('quadrature_' . $i);
                    $layouts_images->bathroom = $request->get('bathroom_' . $i);

                    $layouts_images->save();

                }
            } else {
                if ($request->has('image_' . $i)) {

                    /** Загрузка добавленного изображения */
                    $data_files = self::getRequestFile($request->file('image_' . $i . ''));
                    $layouts_images = $images->upload($data_files, $project_id);
                    $layouts_images['project_id'] = $project_id;
                    $layouts_images['image_alt'] = $request->get('image_alt_' . $i);
                    $layouts_images['title_en'] = $request->get('title_en_' . $i);
                    $layouts_images['title_tr'] = $request->get('title_tr_' . $i);
                    $layouts_images['title_ru'] = $request->get('title_ru_' . $i);
                    $layouts_images['layout'] = $request->get('layout_' . $i);
                    $layouts_images['balcony'] = $request->get('balcony_' . $i);
                    $layouts_images['quadrature'] = $request->get('quadrature_' . $i);
                    $layouts_images['bathroom'] = $request->get('bathroom_' . $i);
                    ProjectsLayoutSlider::create($layouts_images);

                }
            }

        }

        $description_id = $request->get('description_id');

        $layouts_descriptions = ProjectLayoutDescription::find($description_id);

        if ($layouts_descriptions) {
            $layouts_descriptions->fill($request->all())->update();
        } else {
            ProjectLayoutDescription::create($request->all());
        }

        if ($layouts_images) {
            return response()->json(['success' => 'Данные успешно обновленны!',]);
        } else {
            return response()->json(['Не удалось обновить данные!']);
        }
    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */

    public function deleteLayouts(Request $request, $id): JsonResponse
    {
        $query = false;

        /** Удаление изображений */
        $images = new ImageSaver();
        $data_files = self::getRequestFile($request);
        $layout_slide = ProjectsLayoutSlider::find($id);

        if ($images->delete($data_files, $layout_slide)) {
            $query = ProjectsLayoutSlider::destroy($id);
        }

        if (!$query) {

            return response()->json(['Не удалось удалить данные!']);
        }

        return response()->json(['success' => 'Данные успешно удаленно!']);
    }
}
