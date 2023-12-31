<?php

use App\Http\Controllers\AdminForecastsController;
use App\Http\Controllers\ForecastController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use App\Http\Middleware\AdminCheckMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [HomeController::class, 'index']);
Route::get('/about', function(){
    return view('about');
});
Route::get('/contact', function(){
    return view('contact');
});
Route::get('/prognoses', [HomeController::class, 'index']);
Route::get('/forecast/{city:name}/', [ForecastController::class, 'index']);

Route::middleware(['auth', AdminCheckMiddleware::class])->prefix('admin')->group(function()
{
    Route::view("/forecasts", "admin.forecast_index");
    Route::post("/forecasts/store", [AdminForecastsController::class, 'store'])->name('forecasts.store');

    Route::get('/prognoses', [WeatherController::class, 'index'])->name('adminPrognoses');
    Route::get('/all-weather', [WeatherController::class, 'getAllWeather']);
    Route::post('/send-weather', [WeatherController::class, 'sendWeather'])->name('createWeather');
    Route::get('/delete-weather/{weather}', [WeatherController::class, 'delete'])->name('obrisiPrognozu');
    Route::get('/edit-weather/edit/{weather}', [WeatherController::class, 'singleWeather'])->name('weather.single');
    Route::post('/edit-weather/save/{weather}', [WeatherController::class, 'save'])->name('weather.save');


});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
