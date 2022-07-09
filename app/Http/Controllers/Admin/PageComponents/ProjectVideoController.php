<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Http\Controllers\Controller;
use App\Models\Admin\Project;
use App\Models\Admin\ProjectApartmentVideo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ProjectVideoController extends Controller
{
    const PATH = 'admin.projects.components.';

    /**
     * @param $id
     * @return string
     */

    public function video($id): string
    {

        $project = Project::find($id);

        if ( !$project ) { abort(404); }
        return view(self::PATH . 'video', compact([
            'project'
        ]))->render();

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */

    public function videoUpdate(Request $request): JsonResponse
    {

        $project_id = $request->get('video_gable_id');
        $project_type = $request->get('video_gable_type');
        $project_table = $request->all();

        $video = ProjectApartmentVideo::where('video_gable_id', $project_id)->where('video_gable_type', $project_type)->first();

        if ($video !== null) {

            $query = $video->fill($project_table)->update();

        } else {
            $query = ProjectApartmentVideo::create($project_table);
        }

        if (!$query) {
            return response()->json(['Не удалось обновить видео!']);
        }

        return response()->json(['success' => 'Видео успешно обновлена!']);

    }

    public function videoDelete(Request $request): JsonResponse
    {
        $id = $request->get('id');

        $query = ProjectApartmentVideo::destroy($id);

        if (!$query) {
            return response()->json(['Не удалось удалить видео!']);
        }

        return response()->json(['success' => 'Видео успешно удалёна!', 'component' => 'video']);
    }
}
