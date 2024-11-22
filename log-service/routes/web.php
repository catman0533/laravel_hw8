<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/logs', function() {
    return view('logs');
});
Route::get('/logs', function() {
    // Создаём массив данных $result_array
    $result_array = [
        ['id' => 1, 'time' => '2023-10-10 12:00:00', 'duration' => 5, 'url' => '/path', 'method' => 'GET', 'input' => 'sample data'],
        ['id' => 2, 'time' => '2023-10-10 12:10:00', 'duration' => 10, 'url' => '/another-path', 'method' => 'POST', 'input' => 'test input'],
    ];

    // Передаём данные в представление 'logs' через второй аргумент
    return view('logs', ['result_array' => $result_array]);
});


