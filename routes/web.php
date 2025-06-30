<?php

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\AuthCheck;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;




// Route::get('/as', function () {
//     $username = 'Febi';
//     if ($username === 'Febi') {
//         echo 'Halo ' . $username;
//     } else {
//         echo 'Bukan ' . $username;
//     }
// });

// Route::post('/article/create', function () {
//     $article = [
//         "title" => request('title'),
//         "description" => request('description'),
//         "slug" => request('slug'),
//     ];
//     return $article;
// });

// Route::get('/about', function(){
//     $sort = request('sort');
//     $page = request('page');
//     return $sort . ' Halaman ' . $page;
// });

// Route::get('/article', [ArticleController::class, 'index']);
// Route::get('/article/detail/{slug}', [ArticleController::class, 'show']);

// Route::post('/article/create/', function(){
//     $article = [
//         'title' => request('title'),
//         'description' => request('description'),
//         'slug' => request('slug'),
//     ];
//     return $article;
// });

Route::middleware('auth-check')->group(function($router){
$router->get('/', [DashboardController::class, 'index']);

    $router->controller(SensorController::class)->group(function ($subrouter){
        $subrouter->get('/sensor',  'index');
        $subrouter->get('/sensor/create',  'create');
        $subrouter->get('/sensor/edit/{id}',  'edit');
        $subrouter->post('/sensor/store',  'store');
        $subrouter->put('/sensor/update/{id}',  'update');
        $subrouter->delete('/sensor/delete/{id}',  'delete');
    });
});

Route::middleware('is-admin')->group(function($router){
    $router->controller(DeviceController::class)->group(function ($subrouter){
        $subrouter->get('/device', [DeviceController::class, 'index']);
        $subrouter->get('/device/create', [DeviceController::class, 'create']);
        $subrouter->get('/device/edit/{id}', [DeviceController::class, 'edit']);
        $subrouter->post('/device/store', [DeviceController::class, 'store']);
        $subrouter->put('/device/update/{id}', [DeviceController::class, 'update']);
        $subrouter->delete('/device/delete/{id}', [DeviceController::class, 'delete']);
    });
});

Route::get('/register', [AuthController::class, 'viewRegister']);
Route::post('/register', [AuthController::class, 'register']);
// Route::get('/login', [AuthController::class, 'viewLogin']);
// Route::get('/register', [AuthController::class, 'viewRegister']);

// Route::get('/sensor', function () {
//     return view('sensor');
// });

Route::get('/ganti-password', [AuthController::class, 'viewChangePassword']);
Route::post('/ganti-password', [AuthController::class, 'ChangePassword']);
