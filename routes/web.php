<?php
use Illuminate\Support\Facades\Route;

Route::controller(App\Http\Controllers\PagesController::class)->group(function () {
    Route::get('/','index')->name('main-page');
    Route::get('/dashboard','index');
    Route::get('/customer', 'customer')->name('customer');
    Route::get('/customerAccount', 'customerAccount')->name('customer-account');
    Route::get('/customerCalculation', 'customerCalculation')->name('customer-calc');
    Route::get('/note', 'note')->name('my-note');
    Route::get('/profile', 'profile')->name('profile-user');
    Route::get('/report', 'report')->name('report');
    Route::get('/logout', 'logout')->name('logout-user');
});

Route::get('/backup',
    function () {
        $projectDir = substr(getcwd(), 0, strpos(getcwd(), '\public'));
        $command = "cd ".$projectDir . '&& php artisan backup:run --only-db';
        exec($command);
        $download = \Illuminate\Support\Facades\Storage::path('\\sarafi\\').date('Y-m-d-H-i-s').".zip";
        if(file_exists($download)) {
            return response()->download($download);
        }
        return redirect()->back();
    });

Route::get('/login', \App\Http\Livewire\Login::class)->name('login-view');
Route::post('/login', \App\Http\Livewire\Login::class)->name('login-form');
