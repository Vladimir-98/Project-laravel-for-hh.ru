<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meta\MetaRequest;
use App\Models\Admin\Project;
use App\Models\Admin\ProjectApartmentMeta;
use Illuminate\Http\JsonResponse;


class ProjectsMetaController extends Controller
{
    const PATH = 'admin.projects.components.';

    /**
     * @param $id
     * @return string
     */

    public function meta($id): string
    {

        $project = Project::find($id);

        if ( !$project ) { abort(404); }

        return view(self::PATH . 'meta', compact([
            'project'
        ]))->render();

    }

    /**
     * @param MetaRequest $request
     * @return JsonResponse
     */

    public function metaUpdate(MetaRequest $request): JsonResponse
    {

        $data_id = $request->get('meta_gable_id');
        $data_type = $request->get('meta_gable_type');
        $meta_table = $request->all();

        $meta = ProjectApartmentMeta::where('meta_gable_id', $data_id)->where('meta_gable_type', $data_type)->first();

        if ($meta !== null) {

            $query = $meta->fill($meta_table)->update();

        } else {
            $query = ProjectApartmentMeta::create($meta_table);
        }

        if (!$query) {
            return response()->json(['Не удалось обновить мета теги!']);
        }

        return response()->json(['success' => 'Мета теги успешно обновлена!']);

    }
}
