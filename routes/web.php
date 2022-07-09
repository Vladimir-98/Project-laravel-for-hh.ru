<?php

use App\Http\Controllers\Admin\AgreementController;
use App\Http\Controllers\Admin\PageComponents\ApartmentVideoController;
use App\Http\Controllers\Admin\PageComponents\ProjectMapController;
use App\Http\Controllers\Admin\PageComponents\ProjectVideoController;
use App\Services\Localization\LocalizationService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\indexController as AdminIndexController;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use \App\Http\Controllers\Admin\PageComponents\HeaderController;
use \App\Http\Controllers\Admin\PageComponents\AboutController;
use \App\Http\Controllers\Admin\PageComponents\PageReviewController;
use App\Http\Controllers\Admin\PageComponents\MetaController;
use App\Http\Controllers\Admin\PageComponents\PageTitleController;
use App\Http\Controllers\Admin\PageComponents\DesignController;
use App\Http\Controllers\Admin\PageComponents\MapController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\Admin\PageComponents\ApartmentSliderController;
use \App\Http\Controllers\Admin\PageComponents\ProjectSliderController;
use \App\Http\Controllers\Admin\PageComponents\ProjectPlanController;
use App\Http\Controllers\Admin\PageComponents\ProjectProgressController;
use App\Http\Controllers\Admin\PageComponents\ApartmentsMetaController;
use App\Http\Controllers\Admin\PageComponents\ProjectsMetaController;
use App\Http\Controllers\Admin\PageComponents\ApartmentDescriptionController;
use App\Http\Controllers\Admin\PageComponents\ProjectDescriptionController;
use App\Http\Controllers\Admin\PageComponents\ApartmentMapController;
use App\Http\Controllers\Admin\PageComponents\LayoutsSliderController;
use App\Http\Controllers\Admin\PageComponents\ProjectInfrastructureDescriptionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\PageComponents\PageImageController;
use App\Http\Controllers\Admin\PageComponents\PageSliderController;
use App\Http\Controllers\Admin\PageComponents\PageVideoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Localization */

Route::group([
    'prefix' => LocalizationService::locale(),
    'middleware' => 'setLocale'
], function () {

    /* Pages */
    Route::get('/', [PageController::class, 'index']);
    Route::get('/close-modal-agreement', [AgreementController::class, 'closeModalAgreement'])->name('closeModalAgreement');
    Route::get('/installments', [PageController::class, 'installments'])->name('installments');
    Route::get('/agreement', [PageController::class, 'agreement'])->name('agreement');
    Route::get('/interior-design', [PageController::class, 'interiorDesign'])->name('interior-design');
    Route::get('/old-projects', [PageController::class, 'oldProjects'])->name('old-projects');
    Route::get('/projects/{url}', [PageController::class, 'project'])->name('project');
    Route::get('/new-projects', [PageController::class, 'newProjects'])->name('new-projects');
//    Route::get('/get-search', [PageController::class, 'getSearch'])->name('getSearch');
    Route::get('/search-projects', [PageController::class, 'searchProjects'])->name('search-projects');

    Route::get('/apartments', [PageController::class, 'apartments'])->name('apartments');
    Route::get('/apartments/{url}', [PageController::class, 'apartment'])->name('apartment');

    Route::get('/questions', [PageController::class, 'questions'])->name('questions');
    Route::get('/questions/{url}', [PageController::class, 'question'])->name('question');

    Route::get('/news', [PageController::class, 'news'])->name('news');
    Route::get('news/{url}', [PageController::class, 'oneNews'])->name('one-news');

    Route::get('/dashboard', [PageController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

    Route::get('/carts/added-projects', [PageController::class, 'addedProjects'])->name('cartsProjects');
    Route::get('/carts/added-apartments', [PageController::class, 'addedApartments'])->name('cartsApartments');
    Route::post('/carts/carts/add-cart', [CartController::class, 'addToCart'])->name('addToCartProject');

    require __DIR__ . '/auth.php';

    /* Filter */
    Route::get('/add-filter-districts', [FilterController::class, 'addFilterDistricts'])
        ->name('add-filter-districts');
    Route::get('/get-filter', [FilterController::class, 'getFilter'])
        ->name('get-filter');

    Route::get('reviews', [\App\Http\Controllers\ReviewsController::class, 'index'])->name('reviews');
    Route::post('reviews/add-review', [\App\Http\Controllers\ReviewsController::class, 'create'])->name('add-review');

});

/* Admin */
Route::group([
    "as" => "admin.",
    "prefix" => "/admin",
    "middleware" => "admin",
], function () {
//    Route::get('/', [AdminIndexController::class, 'index'])->name('index');
    /* City */
    Route::prefix('cities')->group(function () {
        Route::get('/', [CityController::class, 'index'])->name('cities');
        Route::get('/table', [CityController::class, 'table'])->name('table');
        Route::post('/create', [CityController::class, 'create'])->name('create');
        Route::get('/show', [CityController::class, 'show'])->name('show');
        Route::put('/update', [CityController::class, 'update'])->name('update');
        Route::delete('/destroy', [CityController::class, 'destroy'])->name('destroy');
    });

    /* District */
    Route::prefix('districts')->group(function () {
        Route::get('/', [DistrictController::class, 'index'])->name('districts');
        Route::get('/table', [DistrictController::class, 'table'])->name('table');
        Route::post('/create', [DistrictController::class, 'create'])->name('create');
        Route::get('/show', [DistrictController::class, 'show'])->name('show');
        Route::get('/show-all', [DistrictController::class, 'showAll'])->name('show-all');
        Route::put('/update', [DistrictController::class, 'update'])->name('update');
        Route::delete('/destroy', [DistrictController::class, 'destroy'])->name('destroy');
    });

    /* Project */
    Route::prefix('projects')->group(function () {
        // Table
        Route::get('/', [ProjectController::class, 'index'])->name('projects');
        Route::get('/table', [ProjectController::class, 'table'])->name('table');
        Route::post('/create', [ProjectController::class, 'create'])->name('create');
        Route::get('/show', [ProjectController::class, 'show'])->name('show');
        Route::put('/update', [ProjectController::class, 'update'])->name('update');
        Route::delete('/destroy', [ProjectController::class, 'destroy'])->name('destroy');

        // Modal
        Route::get('/show/{url}', [ProjectController::class, 'showBlade'])->name('show-blade');

        // Slider
        Route::post('/add-images', [ProjectSliderController::class, 'addImages'])->name('add-images');
        Route::put('/update-images', [ProjectSliderController::class, 'updateImages'])->name('update-images');
        Route::get('/delete-image/{id}', [ProjectSliderController::class, 'deleteImage'])->name('delete-image');
        Route::get('/show/slider/{id}', [ProjectSliderController::class, 'slider'])->name('slider');

        // 3d plan
        Route::post('/add-plan-image', [ProjectPlanController::class, 'addImages'])->name('add-plan-image');
        Route::put('/update-plan-image', [ProjectPlanController::class, 'updateImages'])->name('update-plan-image');
        Route::get('/delete-plan-image/{id}', [ProjectPlanController::class, 'deletePlan'])->name('delete-plan-image');
        Route::get('/show/plan/{id}', [ProjectPlanController::class, 'plan'])->name('slider');
        Route::post('/show/plan-delete', [ProjectPlanController::class, 'planDelete'])->name('plan-delete');

        // Quadrature
        Route::post('/add-layouts', [LayoutsSliderController::class, 'addLayouts'])->name('add-layouts');
        Route::put('/update-layouts', [LayoutsSliderController::class, 'updateLayouts'])->name('update-layouts');
        Route::get('/delete-layouts/{id}', [LayoutsSliderController::class, 'deleteLayouts'])->name('delete-layouts');
        Route::get('/show/layouts-slider/{id}', [LayoutsSliderController::class, 'layouts'])->name('layouts-slider');

        // Progress building
        Route::post('/add-progress', [ProjectProgressController::class, 'addProgressImages'])->name('add-progress');
        Route::put('/update-progress', [ProjectProgressController::class, 'updateProgressImages'])->name('update-progress');
        Route::get('/delete-progress/{id}', [ProjectProgressController::class, 'deleteProgressImage'])->name('delete-progress');
        Route::get('/show/progress/{id}', [ProjectProgressController::class, 'progress'])->name('progress');

        // Meta
        Route::get('/show/meta/{id}', [ProjectsMetaController::class, 'meta'])->name('meta');
        Route::put('/show/meta-update', [ProjectsMetaController::class, 'metaUpdate'])->name('meta-update');

        // Description
        Route::get('/show/description/{id}', [ProjectDescriptionController::class, 'description'])->name('description');
        Route::put('/show/description-update', [ProjectDescriptionController::class, 'descriptionUpdate'])->name('description-update');

        // Map
        Route::get('/show/map/{id}', [ProjectMapController::class, 'map'])->name('map');
        Route::put('/show/map-update', [ProjectMapController::class, 'mapUpdate'])->name('map-update');
        Route::post('/show/map-delete', [ProjectMapController::class, 'mapDelete'])->name('map-delete');


        // Video Youtube
        Route::get('/show/video/{id}', [ProjectVideoController::class, 'video'])->name('video');
        Route::put('/show/video-update', [ProjectVideoController::class, 'videoUpdate'])->name('video-update');
        Route::post('/show/video-delete', [ProjectVideoController::class, 'videoDelete'])->name('video-delete');

        // Description
        Route::get('/show/infrastructure/{id}', [ProjectInfrastructureDescriptionController::class, 'infrastructure'])->name('infrastructure');
        Route::post('/show/infrastructure-update', [ProjectInfrastructureDescriptionController::class, 'infrastructureUpdate'])->name('infrastructure-update');
        Route::post('/show/infrastructure-delete', [ProjectInfrastructureDescriptionController::class, 'infrastructureDelete'])->name('infrastructure-delete');
    });

    /* Apartments */
    Route::prefix('apartments')->group(function () {
        Route::get('/', [ApartmentController::class, 'index'])->name('apartments');
        Route::get('/table', [ApartmentController::class, 'table'])->name('table');
        Route::post('/create', [ApartmentController::class, 'create'])->name('create');
        Route::get('/show', [ApartmentController::class, 'show'])->name('show');
        Route::put('/update', [ApartmentController::class, 'update'])->name('update');
        Route::delete('/destroy', [ApartmentController::class, 'destroy'])->name('destroy');
        Route::get('/show/{url}', [ApartmentController::class, 'showBlade'])->name('show-blade');
        Route::put('/update-images', [ApartmentSliderController::class, 'updateImages'])->name('update-images');
        Route::post('/add-images', [ApartmentSliderController::class, 'addImages'])->name('add-images');
        Route::get('/delete-image/{id}', [ApartmentSliderController::class, 'deleteImage'])->name('delete-image');
        Route::get('/show/slider/{id}', [ApartmentSliderController::class, 'slider'])->name('slider');
        Route::get('/show/meta/{id}', [ApartmentsMetaController::class, 'meta'])->name('meta');
        Route::put('/show/meta-update', [ApartmentsMetaController::class, 'metaUpdate'])->name('meta-update');
        Route::get('/show/description/{id}', [ApartmentDescriptionController::class, 'description'])->name('description');
        Route::put('/show/description-update', [ApartmentDescriptionController::class, 'descriptionUpdate'])->name('description-update');

        // Map
        Route::get('/show/map/{id}', [ApartmentMapController::class, 'map'])->name('map');
        Route::put('/show/map-update', [ApartmentMapController::class, 'mapUpdate'])->name('map-update');
        Route::post('/show/map-delete', [ApartmentMapController::class, 'mapDelete'])->name('map-delete');

        // Video Youtube
        Route::get('/show/video/{id}', [ApartmentVideoController::class, 'video'])->name('video');
        Route::put('/show/video-update', [ApartmentVideoController::class, 'videoUpdate'])->name('video-update');
        Route::post('/show/video-delete', [ApartmentVideoController::class, 'videoDelete'])->name('video-delete');

//        Route::get('/show/youtube/{id}', [ApartmentSliderController::class, 'youtube'])->name('youtube');
    });

    /* Questions */
    Route::prefix('questions')->group(function () {
        Route::get('/', [QuestionController::class, 'index'])->name('questions');
        Route::get('/table', [QuestionController::class, 'table'])->name('table');
        Route::post('/create', [QuestionController::class, 'create'])->name('create');
        Route::get('/show', [QuestionController::class, 'show'])->name('show');
        Route::put('/update', [QuestionController::class, 'update'])->name('update');
        Route::delete('/destroy', [QuestionController::class, 'destroy'])->name('destroy');
    });

    /* Review */
    Route::prefix('reviews')->group(function () {
        Route::get('/', [AdminReviewController::class, 'index'])->name('reviews');
        Route::get('/table', [AdminReviewController::class, 'table'])->name('table');
        Route::get('/show', [AdminReviewController::class, 'show'])->name('show');
        Route::put('/update', [AdminReviewController::class, 'update'])->name('update');
        Route::delete('/destroy', [AdminReviewController::class, 'destroy'])->name('destroy');
    });

    /* News */
    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('news');
        Route::get('/table', [NewsController::class, 'table'])->name('table');
        Route::post('/create', [NewsController::class, 'create'])->name('create');
        Route::get('/show', [NewsController::class, 'show'])->name('show');
        Route::put('/update', [NewsController::class, 'update'])->name('update');
        Route::delete('/destroy', [NewsController::class, 'destroy'])->name('destroy');
    });

    /* Pages Admin */
    Route::prefix('/pages/show')->group(function () {
        Route::get('/{id}', [AdminPageController::class, 'show'])->name('show');
        Route::get('/header/{id}', [HeaderController::class, 'header'])->name('header');
        Route::put('/header-update', [HeaderController::class, 'headerUpdate'])->name('header-update');
        Route::get('/about/{id}', [AboutController::class, 'about'])->name('about');
        Route::put('/about-update', [AboutController::class, 'aboutUpdate'])->name('about-update');

        Route::get('/page-slider/{id}', [PageSliderController::class, 'pageSlider'])->name('page-slider');
        Route::post('/add-images', [PageSliderController::class, 'addImages'])->name('add-images');
        Route::put('/update-images', [PageSliderController::class, 'updateImages'])->name('update-images');
        Route::get('/delete-image/{id}', [PageSliderController::class, 'deleteImage'])->name('delete-image');

        Route::get('/video/{id}', [PageVideoController::class, 'video'])->name('video');
        Route::put('/video-update', [PageVideoController::class, 'videoUpdate'])->name('video-update');
        Route::post('/video-delete', [PageVideoController::class, 'videoDelete'])->name('video-delete');

        Route::post('/add-image', [PageImageController::class, 'addImages'])->name('add-image');
        Route::put('/update-image', [PageImageController::class, 'updateImages'])->name('update-image');
        Route::get('/image/{id}', [PageImageController::class, 'image'])->name('page-image');

        Route::get('/review/{id}', [PageReviewController::class, 'review'])->name('review');
        Route::put('/review-update', [PageReviewController::class, 'reviewUpdate'])->name('review-update');
        Route::get('/meta/{id}', [MetaController::class, 'meta'])->name('meta');
        Route::put('/meta-update', [MetaController::class, 'metaUpdate'])->name('meta-update');
        Route::get('/page-title/{id}', [PageTitleController::class, 'pageTitle'])->name('page-title');
        Route::put('/page-title-update', [PageTitleController::class, 'pageTitleUpdate'])->name('page-title-update');
        Route::get('/design/{id}', [DesignController::class, 'design'])->name('design');
        Route::put('/design-update', [DesignController::class, 'designUpdate'])->name('design-update');
        Route::get('/map/{id}', [MapController::class, 'map'])->name('map');
        Route::put('/map-update', [MapController::class, 'mapUpdate'])->name('map-update');
        Route::post('/map-delete', [MapController::class, 'mapDelete'])->name('map-delete');
    });
});
