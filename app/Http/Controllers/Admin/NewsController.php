<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsRequest;
use App\Models\Admin\News;
use App\Models\Admin\NewsImages;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    const PATH = 'admin.news.';

    const IMAGES_POST = 'upload/news/';

    public function getRequestFile($request): array
    {
        return [
            ['name' => 'post', 'big' => ['width' => 240, 'height' => 160], 'small' => ['width' => 100, 'height' => 100], 'path' => self::IMAGES_POST, 'file' => $request->file('post')],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */


    public function index()
    {
        $sort_id = 'desc';
        $page = '1';
        $news = News::orderBy('id', $sort_id)->paginate(5);

        return view(self::PATH . 'index', compact([
                'news',
                'sort_id',
                'page',
            ]
        ));
    }

    public function table(Request $request): string
    {
        $sort_id = $request->get('sort_id');

        $page = $request->get('page');

        $news = News::orderBy('id', $sort_id)->paginate(5);

        return view(self::PATH . 'table', compact([
            'news',
            'sort_id',
            'page'
        ]))->render();
    }

    /**
     * Show the form for creating a new resource.
     * @param NewsRequest $request
     * @return JsonResponse
     */
    public function create(NewsRequest $request): JsonResponse
    {
        $query = News::create($request->all());

        if (!$query) {
            return response()->json(['Не удалось загрузить проект!']);
        }

        /** Загрузка изображений */
        $images_save = new ImageSaver();
        $data_files = self::getRequestFile($request);
        $news_images = $images_save->upload($data_files, $query->id);

        $news_images['news_id'] = $query->id;
        $news_images['post_alt'] = $request->get('post_alt');
        NewsImages::create($news_images);

        return response()->json([
            'success' => 'Новость ' . $request->get('name_ru') . ' успешно добавлена!', 'page' => '1', 'sort' => 'desc',
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @return string
     */
    public function show(Request $request): string
    {
        $delete = false;

        $id = $request->get('id');

        if ($request->get('delete')) {
            $delete = true;
        }

        $news = News::find($id);

        return view(self::PATH . 'modal', compact([
            'news',
            'delete',
        ]))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsRequest $request
     * @return JsonResponse
     */

    public function update(NewsRequest $request): JsonResponse
    {
        $id = $request->get('id');

        /** Обновление изображений */
        $images = new ImageSaver();
        $data_files = self::getRequestFile($request);
        $news_images = NewsImages::where('news_id', $id)->first();
        $images->update($data_files, $news_images);
        $news_data = $images->upload($data_files, $id);

        $news_data['news_id'] = $id;
        $news_data['youtube'] = $request->get('youtube');
        $news_data['post_alt'] = $request->get('post_alt');
        $news_images->fill($news_data)->update();

        /**Обновление проекта*/
        $query = News::find($id)->fill($request->all())->update();

        if (!$query) {
            return response()->json(['Не удалось обновить новость!']);
        }

        return response()->json(['success' => 'Новость ' . $request->get('name_ru') . ' успешно обновлена!']);
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
        $data_files = self::getRequestFile($request);
        $news_images = NewsImages::where('news_id', $id)->first();

        if ($images->delete($data_files, $news_images)) {

            $query = News::destroy($id);

        }

        if (!$query) {

            return response()->json(['Не удалось удалить новость!']);
        }

        return response()->json(['success' => 'Новость ' . $request->get('name_ru') . ' успешно удалёна!']);
    }
}
