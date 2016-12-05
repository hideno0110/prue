<?php

Route::get('/master', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('master')->user();

    //dd($users);

    return view('master');
})->name('master');
