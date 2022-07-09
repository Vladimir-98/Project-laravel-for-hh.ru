<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Http\Controllers\Controller;
use App\Http\Requests\Infrastructure\InfrastructureRequest;
use App\Models\Admin\InfrastructureDescription;
use App\Models\Admin\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectInfrastructureDescriptionController extends Controller
{
    const PATH = 'admin.projects.components.';


    /**
     * @param $id
     * @return string
     */

    public function infrastructure($id): string
    {
        $project = Project::find($id);

        if ( !$project ) { abort(404); }

        return view(self::PATH . 'infrastructure-description', compact([
            'project'
        ]))->render();

    }

    /**
     * @param InfrastructureRequest $request
     * @return JsonResponse
     */

    public function infrastructureUpdate(InfrastructureRequest $request): JsonResponse
    {

        $description_table = $request->all();

        $project_id = $request->get('project_id');

        $description = InfrastructureDescription::where('project_id', $project_id)->first();

        if ($description !== null) {

            $query = $description->fill($description_table)->update();

        } else {

            $query = InfrastructureDescription::create($description_table);

        }

        if (!$query) {
            return response()->json(['Не удалось обновить описание!']);
        }

        return response()->json(['success' => 'Описание успешно обновлено!']);

    }

    public function infrastructureDelete(Request $request): JsonResponse
    {
        $id = $request->get('id');

        $query = InfrastructureDescription::destroy($id);

        if (!$query) {
            return response()->json(['Не удалось удалить описание!']);
        }

        return response()->json(['success' => 'Описание успешно удалённо!', 'component' => 'infrastructure']);
    }
}
