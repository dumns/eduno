<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\CheckoutController;
use App\Livewire\CourseList;
use App\Livewire\Pricing;
use App\Livewire\ShowCourse;
use App\Livewire\StudentQuiz;
use App\Livewire\StudentQuizForm;
use App\Livewire\WatchEpisode;
use App\Models\Course;
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


Route::get('/courses', function () {
    return redirect()->route('dashboard');
})->name('courses');
Route::get('/courses/{course}', ShowCourse::class)->name('courses.show');

// Route::get('/pricing', Pricing::class)->name('pricing');
Route::get('/billing', BillingController::class)->name('billing');
Route::get('/checkout/success', CheckoutController::class)->name('checkout.success');

Route::get('/courses/{course}/episodes/{episode?}', WatchEpisode::class)
    ->middleware(['auth'])
    ->name('courses.episodes.show');

Route::get('/quiz/{quiz}', StudentQuizForm::class)->middleware(['auth'])->name('quiz.student');

Route::redirect('/', '/login');

Route::get('dashboard', function () {
    $courses = Course::with('instructor')->get();
    $personalCourses = auth()->user()->courses()->with('instructor')->get();

    $courseYears = $courses->pluck('created_at')->map(fn ($d) => $d->year)->unique()->sort()->values()->toArray();
    $coursesJson = $courses->map(fn ($c) => [
        'id' => $c->id,
        'title' => $c->title,
        'code' => $c->code ?? '-',
        'instructor_name' => $c->instructor?->name ?? '-',
        'year' => $c->created_at->year,
        'url' => route('courses.show', $c),
    ])->toJson();

    return view('dashboard', compact('courses', 'personalCourses', 'courseYears', 'coursesJson'));
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
