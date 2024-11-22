<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Log;

class DataLogger
{
    private $start_time;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $this->start_time = microtime(true);

        return $next($request);
    }

    public function terminate($request, $response)
    {
        // Функция, которая вызывается после создания ответа пользователю
        if (env('API_DATALOGGER', true)) { // Если в настройках включено API_DATALOGGER, то логгируем
            if (env('API_DATALOGGER_USE_DB', true)) { // Если нужно сохранять в базу API_DATA_LOGGER_USE_DB=true
                $log = new Log;
                $log->time = microtime(true);
                $log->duration = round(microtime(true) - LARAVEL_START, 3);
                $log->ip = $request->getClientIp();
                $log->url = $request->url();
                $log->method = $request->getMethod();
                $log->input = $request->getContent();
                $log->save(); // Сохраняем систему лога в базу
            } else {
                // Если нужно сохранять систему лога в файл
                $logLine = implode(' | ', [
                    date('Y-m-d H:i:s'),
                    "duration=" . round(microtime(true) - LARAVEL_START, 3),
                    "ip=" . $request->getClientIp(),
                    "url=" . $request->url(),
                    "method=" . $request->getMethod(),
                    "input=" . $request->getContent()
                ]);

                $file_name = storage_path() . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . "dataLlog-" . $request->ip() . ".log";

                file_put_contents($file_name, $logLine, FILE_APPEND);
            }
        }
    }
}
