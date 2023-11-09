<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseTemplateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\SearchController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home-trainers', [HomeController::class, 'indexforTrainers'])->name('home-trainers');

Route::get('/search', [SearchController::class, 'search']);

Route::get('trainers', [TrainerController::class, 'index'])->name('trainers');
Route::get('trainers/{id}', [TrainerController::class, 'show'])->name("viewtrainer");
Route::put('trainers/{id}/approve', [TrainerController::class, 'approve'])->middleware(['auth', 'verified'])->name("approvetrainer");
Route::get('trainers/{id}/edit', [TrainerController::class, 'edit'])->middleware(['auth', 'verified'])->name("edittrainer");
Route::delete('trainers/{id}', [TrainerController::class, 'destroy'])->middleware(['auth', 'verified'])->name("deltrainer");
Route::put('trainers/{id}', [TrainerController::class, 'update'])->middleware(['auth', 'verified'])->name("updatetrainer");

// Route::get('send-email', [App\Http\Controllers\EmailController::class, 'sendEmail']);

Route::get('coursetemplates', [CourseTemplateController::class, 'index'])->middleware(['auth', 'verified'])->name('coursetemplates');
Route::post('coursetemplates/store', [CourseTemplateController::class, 'store'])->middleware(['auth', 'verified'])->name("coursetemplates.store");
Route::post('coursetemplates/{id}', [CourseTemplateController::class, 'update'])->middleware(['auth', 'verified'])->name('coursetemplates.approve');
Route::delete('coursetemplates/{id}', [CourseTemplateController::class, 'destroy'])->middleware(['auth', 'verified'])->name('coursetemplates.del');

Route::get('courses', [CourseController::class, 'index'])->middleware(['auth', 'verified'])->name("courses");
Route::get('courses/create', [CourseController::class, 'create'])->middleware(['auth', 'verified'])->name("createcourse");
Route::post('courses/store', [CourseController::class, 'store'])->middleware(['auth', 'verified'])->name("createstore");
Route::put('courses/{id}', [CourseController::class, 'update'])->middleware(['auth', 'verified'])->name("approvecourse");
Route::get('courses/{id}', [CourseController::class, 'show'])->name("viewcourse");

Route::get('enquiries', [EnquiryController::class, 'index'])->middleware(['auth', 'verified'])->name("enquiries");
Route::post('enquiries/store', [EnquiryController::class, 'store'])->name("send-enquiry");


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/backsoon', function () {
    return view('backsoon');
})->name('backsoon');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
