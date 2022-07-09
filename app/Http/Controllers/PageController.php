<?php

namespace App\Http\Controllers;

use App\Models\Admin\Apartments;
use App\Models\Admin\City;
use App\Models\Admin\News;
use App\Models\Admin\Page;
use App\Models\Admin\Project;
use App\Models\Admin\Review;
use App\Models\Admin\Questions;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class PageController extends Controller
{

    /**
     * @return Factory|View|Application
     */

    public function index(): Factory|View|Application
    {
        $date = Carbon::now();
        $new_projects = Project::where('deadline', '<', $date)->limit(6)->get();
        $old_projects = Project::where('deadline', '>', $date)->limit(6)->get();
        $apartments = Apartments::limit(6)->get();
        $questions = Questions::limit(6)->get();
        $news = News::limit(3)->get();
        $page = Page::find(1);
        $reviews = Review::where('review_gable_type', 'App\Models\Admin\Project')->orderBy('id', 'desc')->limit(10)->get();
        return view('index', compact([
            'new_projects',
            'old_projects',
            'apartments',
            'questions',
            'news',
            'page',
            'reviews'
        ]));
    }

    /**
     * @import Request
     * @param Request $request
     * @return string
     */

    public function oldProjects(Request $request): string
    {
        $date = Carbon::now();
        $projects = Project::where('deadline', '<', $date)->paginate(2);
        $cities = City::all();
        $page = Page::find(2);
        $districts = [];
        $operator = '<';
        $desc_price = '';
        $desc_id = '';
        $curr_page = Route::currentRouteName();

        if ($request->get('id')) {
            $desc_id = $request->get('id');
        }
        if ($request->get('price')) {
            $desc_price = $request->get('price');
        }

        if ($request->get('page')) {
            return view('layouts.projects', compact([
                'projects',
                'cities',
                'page',
                'districts',
                'operator',
                'desc_price',
                'desc_id',
                'curr_page',

            ]))->render();
        }

        return view('old-projects', compact([
            'projects',
            'cities',
            'page',
            'districts',
            'operator',
            'desc_price',
            'desc_id',
            'curr_page'
        ]));
    }

    /**
     * @import Request
     * @param Request $request
     * @return string
     */

    public function newProjects(Request $request): string
    {
        $date = Carbon::now();
        $projects = Project::where('deadline', '>', $date)->paginate(2);
        $cities = City::all();
        $page = Page::find(3);
        $districts = [];
        $operator = '>';
        $desc_price = '';
        $desc_id = '';
        $curr_page = Route::currentRouteName();

        if ($request->get('id')) {
            $desc_id = $request->get('id');
        }
        if ($request->get('price')) {
            $desc_price = $request->get('price');
        }

        if ($request->get('page')) {
            return view('layouts.projects', compact([
                'projects',
                'cities',
                'page',
                'districts',
                'operator',
                'desc_price',
                'desc_id',
                'curr_page',
            ]))->render();
        }

        return view('new-projects', compact([
            'projects',
            'cities',
            'page',
            'districts',
            'operator',
            'desc_price',
            'desc_id',
            'curr_page'
        ]));
    }

    /**
     * @import Request
     * @param Request $request
     * @return string
     */

    public function apartments(Request $request): string
    {
        $apartments = Apartments::paginate(3);
        $cities = City::all();
        $page = Page::find(4);
        $districts = [];
        $projects = '';
        $desc_price = '';
        $desc_id = '';

        if ($request->get('id')) {
            $desc_id = $request->get('id');
        }
        if ($request->get('price')) {
            $desc_price = $request->get('price');
        }

        if ($request->get('page')) {
            return view('layouts.apartments', compact([
                'apartments',
                'cities',
                'page',
                'districts',
                'desc_price',
                'desc_id'
            ]))->render();
        }

        return view('apartments', compact([
            'apartments',
            'cities',
            'page',
            'districts',
            'desc_price',
            'desc_id'
        ]));
    }

    /**
     * @import Request
     * @param Request $request
     * @param $url
     * @return string
     */

    public function apartment(Request $request, $url): string
    {
        $id = explode('-', $url)[0];

        $apartment = Apartments::find($id);

        $populars = Apartments::orderBy('id', 'desc')->limit(5)->get();

        $lang = app()->getLocale();

        $title_arr = [
            'title_en' => 'Buy a ' . $apartment->layout . '-room apartment of ' . $apartment->quadrature . 'м² in ' . $apartment->city['name_' . $lang] . ', Turkey in the ' . $apartment->district['name_' . $lang] . ' district for ' . $apartment->price . ' euros.',
            'title_tr' => 'Türkiye\'de ' . $apartment->layout . ' odalı bir daire satın alın ' . $apartment->city['name_' . $lang] . ' şehri ' . $apartment->district['name_' . $lang] . ' ' . $apartment->price . ' Euro\'ya kadar',
            'title_ru' => 'Купить ' . $apartment->layout . '-комнатную квартиру ' . $apartment->quadrature . 'м² город ' . $apartment->city['name_' . $lang] . ' Турция в районе ' . $apartment->district['name_' . $lang] . ' за ' . $apartment->price . ' евро.',
        ];

        $description = [
            'description_en' => 'Turkey ' . $apartment->city['name_' . $lang] . ' city to buy a ' . $apartment->layout . '-room apartment in the ' . $apartment->district['name_' . $lang] . ' area on the Mediterranean coast. The area of the apartment is ' . $apartment->quadrature . ' м², ' . $apartment->floor . ' floor, ' . $apartment->sea . ' m to the sea, the price is ' . $apartment->price . ' euros.',
            'description_tr' => 'Türkiye\'nin ' . $apartment->city['name_' . $lang] . ' şehri, Akdeniz kıyısındaki ' . $apartment->district['name_' . $lang] . ' ' . $apartment->layout . ' odalı bir daire satın alıyor. Dairenin alanı ' . $apartment->layout . 'м², ' . $apartment->floor . ' kat, denize ' . $apartment->sea . ' metre, fiyatı ' . $apartment->price . ' Euro\'dur.',
            'description_ru' => 'Турция город ' . $apartment->city['name_' . $lang] . ' купить ' . $apartment->layout . '-комнатную квартиру в районе ' . $apartment->district['name_' . $lang] . ' на берегу средиземного моря. Площадь квартиры составляет ' . $apartment->quadrature . ' м², этаж ' . $apartment->floor . ', до моря ' . $apartment->sea . ' метров, цена ' . $apartment->price . ' евро.',
        ];

        $urls_arr = [
            'url_en' => $apartment->id . ' apartment for sale ' . $apartment->layout . '+1 turkey',
            'url_tr' => $apartment->id . ' satılık daire ' . $apartment->layout . '+1 ' . $apartment->city['name_' . $lang] . ' Türkiye',
            'url_ru' => $apartment->id . ' продажа квартиры ' . $apartment->layout . '+1 ' . $apartment->city['name_' . $lang] . ' турция',
        ];

        $h1_arr = [
            'h_en' => 'for sale ' . $apartment->layout . '-room apartment, area ' . $apartment->quadrature . ' м²',
            'h_tr' => 'satılık ' . $apartment->layout . ' odalı daire, alan ' . $apartment->quadrature . ' м²',
            'h_ru' => 'продается ' . $apartment->layout . '-комнатная квартира, площадь ' . $apartment->quadrature . ' м²',
        ];

        return view('apartment', compact([
            'apartment',
            'populars',
            'title_arr',
            'description',
            'urls_arr',
            'h1_arr',
        ]));

    }

    /**
     * @import Request
     * @param Request $request
     * @param $url
     * @return string
     */


    public function project(Request $request, $url): string
    {
        $id = explode('-', $url)[0];

        $project = Project::find($id);

        if (!$project) {
            abort(404);
        }
        $lang = app()->getLocale();

        $stage = ['en' => 'finished', 'tr' => 'Hazır', 'ru' => 'готовом'];

        if ($project->deadline > new Carbon()) {
            $stage = ['en' => 'construction', 'tr' => 'Yapım aşamasında olan', 'ru' => 'строящемся'];
        }

        $title_arr = [
            'title_en' => 'Apartments in the project ' . $project->name_en . ' ' . $project->city->name_en . ' Turkey under ' . $stage[$lang] . ', the sale price at the construction stage starts from ' . $project->price . ' euros.',
            'title_tr' => $stage[$lang] . ' ' . $project->name_tr . ' ' . $project->city->name_tr . ' Türkiye projesindeki daireler, yapım aşamasında satış fiyatı ' . $project->price . ' Euro\'dan başlıyor.',
            'title_ru' => 'Квартиры в ' . $stage[$lang] . ' проекте ' . $project->name_ru . ' ' . $project->city->name_ru . ' Турция, цена продажи на стадии строительства от ' . $project->price . ' евро.',
        ];


        $urls_arr = [
            'url_en' => $project->id . ' residential complex ' . $project['name_' . $lang] . ' ' . $project->city['name_' . $lang] . ' turkey',
            'url_tr' => $project->id . ' konut kompleksi ' . $project['name_' . $lang] . ' ' . $project->city['name_' . $lang] . ' türkiye',
            'url_ru' => $project->id . ' жилой комплекс ' . $project['name_' . $lang] . ' ' . $project->city['name_' . $lang] . ' турция',
        ];

        $quantity = 1;

        $quantity >= count($project->reviews) ? $reviews_length = false : $reviews_length = true;

        $reviews = Review::where('review_gable_id', $id)
            ->where('review_gable_type', 'App\Models\Admin\Project')
            ->where('status', true)
            ->orderBy('id', 'desc')
            ->limit($quantity)
            ->get();

        return view('project', compact([
            'project',
            'urls_arr',
            'title_arr',
            'reviews',
            'quantity',
            'reviews_length',
        ]));
    }


    /**
     * @import Request
     * @param Request $request
     * @return string
     */

    public function questions(Request $request): string
    {
        $page = Page::find(5);
        $questions = Questions::paginate(5);
        $populars = Questions::limit(3)->get();


        if ($request->get('page')) {
            return view('layouts.question', compact([
                'page',
                'questions',
                'populars'
            ]))->render();
        }

        return view('questions', compact([
            'page',
            'questions',
            'populars'
        ]));
    }

    /**
     * @import Request
     * @param Request $request
     * @param $url
     * @return Application|Factory|View
     */

    public function question(Request $request, $url): Factory|View|Application
    {
        $id = explode('-', $url)[0];

        $question = Questions::find($id);

        if (!$question) {
            abort(404);
        }

        $populars = Questions::limit(5)->get();

        $lang = app()->getLocale();

        $title_arr = [
            'title_en' => $question['title_' . $lang] . ' - ' . date_format($question->created_at, 'd.m.Y'),
            'title_tr' => $question['title_' . $lang] . ' - ' . date_format($question->created_at, 'd.m.Y'),
            'title_ru' => $question['title_' . $lang] . ' - ' . date_format($question->created_at, 'd.m.Y'),
        ];

        $description = [
            'description_en' => 'Detailed answer of  company to the question «' . $question['title_' . $lang] . '». Assistance in buying an apartment, registration of real estate and documents in Turkey.',
            'description_tr' => 'şirketinin detaylı cevabı, soruya «' . $question['title_' . $lang] . '». Daire satın alma, gayrimenkul tescili ve Türkiye belgeleriyle ilgili yardım. ',
            'description_ru' => 'Подробный ответ компании , на вопрос «' . $question['title_' . $lang] . '». Помощь в покупки квартиры, оформления недвижимости и документов Турции.',
        ];

        return view('question', compact([
            'question',
            'populars',
            'title_arr',
            'description',
        ]));
    }

    /**
     * @import Request
     * @param Request $request
     * @return string
     */

    public function news(Request $request): string
    {
        $page = Page::find(7);
        $news = News::paginate(5);
        $populars = News::orderBy('id', 'desc')->limit(5)->get();

        if ($request->get('page')) {
            return view('layouts.news', compact([
                'page',
                'news',
                'populars'
            ]))->render();
        }
        return view('news', compact([
            'page',
            'news',
            'populars'
        ]));
    }

    /**
     * @import Request
     * @param Request $request
     * @param $url
     * @return Application|Factory|View
     */

    public function oneNews(Request $request, $url): Factory|View|Application
    {

        $id = explode('-', $url)[0];

        $one_news = News::find($id);

        if (!$one_news) {
            abort(404);
        }

        $populars = News::orderBy('id', 'desc')->limit(5)->get();

        $lang = app()->getLocale();

        $title_arr = [
            'title_en' => $one_news['title_' . $lang] . ' - ' . date_format($one_news->created_at, 'd.m.Y'),
            'title_tr' => $one_news['title_' . $lang] . ' - ' . date_format($one_news->created_at, 'd.m.Y'),
            'title_ru' => $one_news['title_' . $lang] . ' - ' . date_format($one_news->created_at, 'd.m.Y'),
        ];

        $description = [
            'description_en' => $one_news['title_' . $lang] . ', ' . date_format($one_news->created_at, 'd.m.Y') . '. News from  construction company',
            'description_tr' => $one_news['title_' . $lang] . ', ' . date_format($one_news->created_at, 'd.m.Y') . '. İnşaat şirketi \'dan haberler',
            'description_ru' => $one_news['title_' . $lang] . ', ' . date_format($one_news->created_at, 'd.m.Y') . '. Новости от строительной компании ',
        ];

        return view('one-news', compact([
            'one_news',
            'populars',
            'title_arr',
            'description',
        ]));
    }

    /**
     *
     */

    public function installments(): Factory|View|Application
    {
        $page = Page::find(6);

        return view('installment', compact([
            'page',
        ]));
    }

    public function dashboard()
    {
        abort(404);
    }

    /**
     * @param Request $request
     * @return string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */

    public function addedProjects(Request $request): string
    {
        $projects_session = session()->get('data.projects');
        $projects = [];
        $quantity = 2;
        $projects_length = true;

        !$request->get('page') ? $page = $quantity : (int)$page = $request->get('page') + $quantity;

        if ($projects_session) {
            foreach ($projects_session as $key => $value) {
                if ($key < $page) {
                    if (Project::find($value)) {
                        array_push($projects, Project::find($value));
                        if (!array_key_exists($key + 1, $projects_session)) {
                            $projects_length = false;
                        }
                    }
                }
            }
        }

        if (isset($projects_session) && count($projects_session) < $quantity) {
            $projects_length = false;
        }

        if ($request->get('page')) {
            return view('layouts.added.projects', compact([
                'projects',
                'page',
                'projects_length',
            ]))->render();

        } else {
            return view('added-projects', compact([
                'projects',
                'page',
                'projects_length'
            ]));
        }

    }

    /**
     * @param Request $request
     * @return string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */

    public function addedApartments(Request $request): string
    {
        $apartments_session = session()->get('data.apartments');
        $apartments = [];
        $quantity = 2;
        $apartments_length = true;

        !$request->get('page') ? $page = $quantity : (int)$page = $request->get('page') + $quantity;

        if ($apartments_session) {
            foreach ($apartments_session as $key => $value) {

                if ($key < $page) {
                    if (Apartments::find($value)) {
                        array_push($apartments, Apartments::find($value));
                        if (!array_key_exists($key + 1, $apartments_session)) {
                            $apartments_length = false;
                        }
                    }
                }
            }
        }
        if (isset($apartments_session) && count($apartments_session) < $quantity) {
            $apartments_length = false;
        }

        if ($request->get('page')) {


            return view('layouts.added.apartments', compact([
                'apartments',
                'page',
                'apartments_length',
            ]))->render();

        } else {
            return view('added-apartments', compact([
                'apartments',
                'page',
                'apartments_length'
            ]));
        }

    }

    public function agreement(): Factory|View|Application
    {
        $page = Page::find(8);

        return view('agreement', compact([
            'page',
        ]));
    }

    public function interiorDesign(): Factory|View|Application
    {
        $page = Page::find(9);
        $quantity = 1;
        $quantity >= count($page->pageReviews) ? $reviews_length = false : $reviews_length = true;

        $reviews = Review::where('review_gable_id', $page->id)
            ->where('review_gable_type', 'App\Models\Admin\Page')
            ->where('status', true)
            ->orderBy('id', 'desc')
            ->limit($quantity)
            ->get();

        return view('interior-design', compact([
            'page',
            'reviews',
            'reviews_length'
        ]));
    }

    /**
     * @import Request
     * @param Request $request
     * @return string
     */

    public function searchProjects(Request $request): string
    {
        $search = $request->get('search');
        $projects = [];
        if ($search) {
            if (!$projects = Project::where('name_en', 'like', '%' . $search . '%')->get()) {
                if (!$projects = Project::where('name_tr', 'like', '%' . $search . '%')->get()) {
                    $projects = Project::where('name_ru', 'like', '%' . $search . '%')->get();
                }
            }
        }
        return view('search-projects', compact([
            'projects',
            'search'
        ]));
    }
}
