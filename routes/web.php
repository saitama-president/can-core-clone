<?php



Route::get('/', function () {
    return view('welcome');
});

Route::get('play',function () {
    return view('play');
});
