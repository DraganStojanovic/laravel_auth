<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use App\Models\Weather;
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

Route::middleware('auth')->prefix('admin')->group(function()
{
    Route::get('/prognoses', [WeatherController::class, 'index']);
    Route::get('/all-weather', [WeatherController::class, 'getAllWeather']);
    Route::post('/send-weather', [WeatherController::class, 'sendWeather']);
    Route::get('/delete-weather/{weather}', [WeatherController::class, 'delete'])->name('obrisiPrognozu');
    Route::get('/edit-weather/edit/{id}', [WeatherController::class, 'singleWeather'])->name('weather.single');
    Route::post('/edit-weather/save/{id}', [WeatherController::class, 'save'])->name('weather.save');
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
