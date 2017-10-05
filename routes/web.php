<?php



Route::get('/', function () {
    return view('play');
});

Route::get('play',function () {
    return view('play');
});

Route::get('test',function () {
    
    $user=new App\CCC\data\user();
    \Event::Fire(new \App\Events\UserRegistedEvent($user));
    
    return ["OK"];
});
