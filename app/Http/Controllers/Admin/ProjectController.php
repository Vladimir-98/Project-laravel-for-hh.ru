<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectRequest;
use App\Models\Admin\City;
use App\Models\Admin\Project;
use App\Models\Admin\ProjectApartmentMap;
use App\Models\Admin\ProjectApartmentMeta;
use App\Models\Admin\ProjectApartmentVideo;
use App\Models\Admin\ProjectImage;
use App\Models\Admin\ProjectLayoutDescription;
use App\Models\Admin\ProjectPlan;
use App\Models\Admin\ProjectsLayoutSlider;
use App\Models\Admin\ProjectsSlider;
use App\Models\Admin\ProjectsProgress;
use App\Models\Admin\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\ImageSaver;

class ProjectController extends Controller
{
    const PATH = 'admin.projects.';

    const IMAGES_LOGO = 'upload/projects/logo/';

    const IMAGES_POST = 'upload/projects/post/';

    const IMAGES_CATALOG = 'upload/projects/catalog/';

    public function getRequestFile($request): array
    {
        return [
            ['name' => 'catalog', 'big' => ['width' => 520, 'height' => 320], 'medium' => ['width' => 330, 'height' => 203], 'path' => self::IMAGES_CATALOG, 'file' => $request->file('catalog')],
//            ['name' => 'post', 'big' => ['width' => 326, 'height' => 326], 'medium' => ['width' => 50, 'height' => 50], 'path' => self::IMAGES_POST, 'file' => $request->file('post')],
            ['name' => 'logo', 'big' => ['width' => 77, 'height' => 55], 'path' => self::IMAGES_LOGO, 'file' => $request->file('logo')],
        ];
    }


    public function index()
    {
        $sort_id = 'desc';
        $page = '1';
        $projects = Project::orderBy('id', $sort_id)->paginate(3);

        return view(self::PATH . 'index', compact([
                'projects',
                'sort_id',
                'page',
            ]
        ));
    }

    public function table(Request $request): string
    {
        $sort_id = $request->get('sort_id');

        $page = $request->get('page');

        $projects = Project::orderBy('id', $sort_id)->paginate(3);

        return view(self::PATH . 'table', compact([
            'projects',
            'sort_id',
            'page'
        ]))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ProjectRequest $request
     * @return JsonResponse
     */

    public function create(ProjectRequest $request): JsonResponse
    {
        $query = Project::create($request->all());

        if (!$query) {
            return response()->json(['Не удалось загрузить проект!']);
        }

        /** Загрузка изображений */
        $images_save = new ImageSaver();
        $data_files = self::getRequestFile($request);
        $project_images = $images_save->upload($data_files, $query->id);

        $project_images['project_id'] = $query->id;
//        $project_images['post_alt'] = $request->get('post_alt');
        $project_images['catalog_alt'] = $request->get('catalog_alt');
        $project_images['logo_alt'] = $request->get('logo_alt');
        ProjectImage::create($project_images);

        return response()->json([
            'success' => 'Проект ' . $request->get('name_ru') . ' успешно добавлен!', 'page' => '1', 'sort' => 'desc',
        ]);

    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @return string
     */
    public function show(Request $request): string
    {
        $delete = false;

        $districts = false;

        $id = $request->get('id');

        if ($request->get('delete')) {
            $delete = true;
        }

        $project = Project::find($id);

        $cities = City::all();

        if ($request->get('id') && !empty($project->city->id)) {
            $districts = City::find($project->city->id)->districts;
        }

        return view(self::PATH . 'modal', compact([
            'project',
            'delete',
            'cities',
            'districts',
        ]))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest $request
     * @return JsonResponse
     */

    public function update(ProjectRequest $request): JsonResponse
    {
        $id = $request->get('id');

        /** Обновление изображений */
        $images = new ImageSaver();
        $data_files = self::getRequestFile($request);
        $project_images = ProjectImage::where('project_id', $id)->first();
        $images->update($data_files, $project_images);
        $project_data = $images->upload($data_files, $id);

        $project_data['project_id'] = $id;
//        $project_data['post_alt'] = $request->get('post_alt');
        $project_data['catalog_alt'] = $request->get('catalog_alt');
        $project_data['logo_alt'] = $request->get('logo_alt');
        $project_images->fill($project_data)->update();

        /**Обновление проекта*/
        $query = Project::find($id)->fill($request->all())->update();

        if (!$query) {
            return response()->json(['Не удалось обновить проект!']);
        }

        return response()->json(['success' => 'Проект ' . $request->get('name_ru') . ' успешно обновлен!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * //     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $query = false;

        $id = $request->get('id');

        /** Удаление изображений */

        $images = new ImageSaver();
        $project = Project::find($id);

        if ($project->plan) {
            unlink('upload/projects/plan/' . $project->plan->image);
            unlink('upload/projects/plan/' . $project->plan->image_medium);
            ProjectPlan::destroy($project->plan->id);
        }

        if ($project->sliders) {
            foreach ($project->sliders as $slider) {
                unlink('upload/projects/slider/' . $slider->image);
                unlink('upload/projects/slider/' . $slider->image_medium);
                ProjectsSlider::destroy($slider->id);
            }
        }

        if ($project->progress) {
            foreach ($project->progress as $progress) {
                unlink('upload/projects/progress/' . $progress->image);
                ProjectsProgress::destroy($progress->id);
            }
        }

        if ($project->layoutSlider) {
            foreach ($project->layoutSlider as $layout) {
                unlink('upload/projects/layouts/' . $layout->image);
                ProjectsLayoutSlider::destroy($layout->id);
            }
        }

        if( $project->layoutDescription ) { ProjectLayoutDescription::destroy($project->layoutDescription->id); }
        if( $project->meta ) { ProjectApartmentMeta::destroy($project->meta->id); }
        if ( $project->map ) { ProjectApartmentMap::destroy($project->map->id); }
        if ( $project->video ) { ProjectApartmentVideo::destroy($project->video->id); }

        foreach ($project->reviews as $review) {
            Review::destroy($review->id);
        }

        $data_files = self::getRequestFile($request);
        $images->delete($data_files, $project->images);
        $query = Project::destroy($id);

        if (!$query) {
            return response()->json(['Не удалось удалить проект!']);
        }

        return response()->json(['success' => 'Проект ' . $request->get('name_ru') . ' успешно удалён!']);
    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @param $id
     * @return string
     */

    public function showBlade(Request $request, $id): string
    {
        $project = Project::find($id);

        if (!$project) {
            abort(404);
        }
        return view(self::PATH . 'show', compact([
            'project'
        ]))->render();
    }
}
