<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\QuestionRequest;
use App\Models\Admin\Questions;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    const PATH = 'admin.questions.';

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */


    public function index()
    {
        $sort_id = 'desc';
        $page = '1';
        $questions = Questions::orderBy('id', $sort_id)->paginate(5);

        return view(self::PATH . 'index', compact([
                'questions',
                'sort_id',
                'page',
            ]
        ));
    }

    public function table(Request $request): string
    {
        $sort_id = $request->get('sort_id');

        $page = $request->get('page');

        $questions = Questions::orderBy('id', $sort_id)->paginate(5);

        return view(self::PATH . 'table', compact([
            'questions',
            'sort_id',
            'page'
        ]))->render();
    }

    /**
     * Show the form for creating a new resource.
     * @param QuestionRequest $request
     * @return JsonResponse
     */
    public function create(QuestionRequest $request): JsonResponse
    {
        $request->validated();

        $query = Questions::create($request->all());

        if (!$query) {
            return response()->json(['Не удалось загрузить вопрос!']);
        }

        return response()->json(['success' => 'Вопрос ' . $request->get('title_en') . ' успешно добавлен!', 'page' => '1', 'sort' => 'desc']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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

        $question = Questions::find($id);

        return view(self::PATH . 'modal', compact([
            'question',
            'delete',
        ]))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuestionRequest $request
     * @return JsonResponse
     */

    public function update(QuestionRequest $request): JsonResponse
    {
        $request->validated();

        $id = $request->get('id');

        $query = Questions::find($id)->fill($request->all())->update();

        if (!$query) {
            return response()->json(['Не удалось обновить вопрос!']);
        }

        return response()->json(['success' => 'Вопрос ' . $request->get('title_ru') . ' успешно обновлен!']);
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
        $id = $request->get('id');

        $query = Questions::destroy($id);

        if (!$query) {
            return response()->json(['Не удалось удалить вопрос!']);
        }
        return response()->json(['success' => 'Вопрос ' . $request->get('title_ru') . ' успешно удалён!']);
    }
}
