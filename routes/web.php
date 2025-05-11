<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('auth.register');

Route::get('/main', function () {
    return view('main.homepage');
})->name('main.homepage');

Route::get('/login', function () {
    return view('auth.login');
})->name('auth.login');


Route::post('/handelregister', [Authcontroller::class,'handelregister'])->name('auth.handelregister');
Route::post('/handellogin', [Authcontroller::class,'handellogin'])->name('auth.handellogin');
Route::post('/logout', [Authcontroller::class,'logout'])->name('auth.logout');

Route::prefix('events')->group(function () {


    Route::group(['middleware'=>'admin'], function () {

        Route::get('/dashboard',function(){
            $events=Event::all();
            $users=User::all();
            return view('dashboard.main',['events'=>$events,'users'=>$users]);
        })->name('dashboard.main');

      Route::get('/create', function () {
        $categories = Category::all();
        return view('events.create', ['categories' => $categories]);
    })->name('events.create');

    Route::post('/store', [EventController::class, 'store'])->name('events.store');

    Route::get('/edit/{id}', function ($id) {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        return view('events.edit', ['event' => $event, 'categories' => $categories]);
    })->name('events.edit');

    Route::post('/update/{id}',[EventController::class,'update'])->name('events.update');
    Route::post('/delete/{id}',[EventController::class,'delete'])->name('events.delete');

    });
    Route::get('/', function () {
        $events = Event::paginate(6);
        return view('main.homepage', ['events' => $events]);
    })->name('main.homepage');

  
    Route::get('/show/{id}',[EventController::class,'show'])->name('events.show');
   
    Route::post('/booking/{id}',[BookingController::class,'book'])->name('book.events');

    Route::get('/cancelbooking/{id}',[BookingController::class,'cancel'])->name('events.cancel');

});













