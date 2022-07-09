<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Http\Controllers\Controller;
use App\Http\Requests\Description\DescriptionRequest;
use App\Models\Admin\Apartments;
use App\Models\Admin\Description;
use Illuminate\Http\JsonResponse;

class ApartmentDescriptionController extends Controller
{
    const PATH = 'admin.apartments.components.';


    /**
     * @param $id
     * @return string
     */

    public function description ($id): string
    {
        $apartment = Apartments::find($id);

        if ( !$apartment ) { abort(404); }

        return view(self::PATH . 'description', compact([
            'apartment'
        ]))->render();

    }

    /**
     * @param DescriptionRequest $request
     * @return JsonResponse
     */

    public function descriptionUpdate(DescriptionRequest $request): JsonResponse
    {

        $data_id = $request->get('description_gable_id');
        $data_type = $request->get('description_gable_type');
        $description_table = $request->all();

        $description = Description::where('description_gable_id', $data_id)->where('description_gable_type', $data_type)->first();

        if ($description !== null) {

            $query = $description->fill($description_table)->update();

        } else {
            $query = Description::create($description_table);
        }

        if (!$query) {
            return response()->json(['Не удалось обновить описание!']);
        }

        return response()->json(['success' => 'Описание успешно обновлено!']);

    }
}
