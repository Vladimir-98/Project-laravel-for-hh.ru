<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apartments\ApartmentsRequest;
use App\Models\Admin\Apartments;
use App\Models\Admin\ApartmentsImages;
use App\Models\Admin\ApartmentsSlider;
use App\Models\Admin\City;
use App\Models\Admin\Description;
use App\Models\Admin\Project;
use App\Models\Admin\ProjectApartmentMap;
use App\Models\Admin\ProjectApartmentVideo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ApartmentController extends Controller
{

    const PATH = 'admin.apartments.';

    const IMAGES_POST = 'upload/apartments/post/';

    public function getRequestFile($request): array
    {
        return [
            ['name' => 'post', 'big' => ['width' => 326, 'height' => 326], 'small' => ['width' => 100, 'height' => 100], 'path' => self::IMAGES_POST, 'file' => $request->file('post')],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $sort_id = 'desc';
        $page = '1';
        $apartments = Apartments::orderBy('id', $sort_id)->paginate(3);

        return view(self::PATH . 'index', compact([
                'apartments',
                'sort_id',
                'page',
            ]
        ));
    }


    public function table(Request $request): string
    {
        $sort_id = $request->get('sort_id');

        $page = $request->get('page');

        $apartments = Apartments::orderBy('id', $sort_id)->paginate(3);

        return view(self::PATH . 'table', compact([
            'apartments',
            'sort_id',
            'page'
        ]))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ApartmentsRequest $request
     * @return JsonResponse
     */

    public function create(ApartmentsRequest $request): JsonResponse
    {
        $query = Apartments::create($request->all());

        if (!$query) {
            return response()->json(['Не удалось загрузить квартиру!']);
        }

        /** Загрузка изображений */
        $images_save = new ImageSaver();
        $data_files = self::getRequestFile($request);
        $apartments_images = $images_save->upload($data_files, $query->id);

        $apartments_images['apartment_id'] = $query->id;
        $apartments_images['post_alt'] = $request->get('post_alt');
        ApartmentsImages::create($apartments_images);

        return response()->json([
            'success' => 'Квартира ' . $request->get('name_ru') . ' успешно добавлена!', 'page' => '1', 'sort' => 'desc',
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

        $projects = false;

        $id = $request->get('id');

        if ($request->get('delete')) {
            $delete = true;
        }

        $apartments = Apartments::find($id);

        $cities = City::all();

        if ($request->get('id') && !empty($apartments->city->id)) {
            $districts = City::find($apartments->city->id)->districts;
        }
        $projects = Project::all();

        return view(self::PATH . 'modal', compact([
            'apartments',
            'delete',
            'cities',
            'districts',
            'projects',

        ]))->render();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param ApartmentsRequest $request
     * @return JsonResponse
     */

    public function update(ApartmentsRequest $request): JsonResponse
    {
        $id = $request->get('id');

        /** Обновление изображений */
        $images = new ImageSaver();
        $data_files = self::getRequestFile($request);
        $apartments_images = ApartmentsImages::where('apartment_id', $id)->first();
        $images->update($data_files, $apartments_images);
        $apartments_data = $images->upload($data_files, $id);

        $apartments_data['apartment_id'] = $id;
        $apartments_data['post_alt'] = $request->get('post_alt');
        $apartments_images->fill($apartments_data)->update();

        /** Обновление квартиры */
        $query = Apartments::find($id)->fill($request->all())->update();

        if (!$query) {
            return response()->json(['Не удалось обновить квартиру!']);
        }

        return response()->json(['success' => 'Квартира ' . $request->get('name_ru') . ' успешно обновлена!']);
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

        $apartment = Apartments::find($id);

        /** Удаление изображений */
        $images = new ImageSaver();

        $apartment_images = ApartmentsImages::where('apartment_id', $id)->first();

        $apartment_sliders = ApartmentsSlider::where('apartment_id', $id)->get();

        if ($apartment_sliders) {
            foreach ($apartment_sliders as $slider) {
                unlink('upload/apartments/slider/' . $slider->image);
                unlink('upload/apartments/slider/' . $slider->image_medium);
                unlink('upload/apartments/slider/' . $slider->image_small);
                ApartmentsSlider::destroy($slider->id);
            }

        }

        if ( $apartment->description ) { Description::destroy($apartment->description->id); }
//        if ( $apartment->meta ) { ProjectApartmentMeta::destroy($apartment->meta->id); }
        if ( $apartment->map ) { ProjectApartmentMap::destroy($apartment->map->id); }
        if ( $apartment->video ) { ProjectApartmentVideo::destroy($apartment->video->id); }

        $data_files = self::getRequestFile($request);
        $images->delete($data_files, $apartment_images);
        $query = Apartments::destroy($id);

        if (!$query) {

            return response()->json(['Не удалось удалить квартиру!']);
        }

        return response()->json(['success' => 'Квартира ' . $request->get('name_ru') . ' успешно удалена!']);
    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @param $id
     * @return string
     */

    public function showBlade(Request $request, $id): string
    {
        $apartment = Apartments::find($id);

        if (!$apartment) {
            abort(404);
        }
        return view(self::PATH . 'show', compact([
            'apartment'
        ]))->render();
    }
}
