<?php

namespace App\Http;
namespace App\Http\Middleware;
   


use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Глобальные middleware-программы, которые будут применены ко всем запросам.
     *
     * @var array
     */
    protected $middleware = [
        
        \Illuminate\Http\Middleware\HandleCors::class,
       
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\DataLogger::class, // Добавленный middleware
    ];
}