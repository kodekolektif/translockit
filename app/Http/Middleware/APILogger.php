<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class APILogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Capture the start time
        $request->attributes->set('start_time', microtime(true));

        return $next($request);
    }

    /**
     * Handle tasks after the response has been sent to the browser.
     */
    public function terminate($request, $response)
    {
        // Get the start time from the request
        $startTime = $request->attributes->get('start_time');
        $duration = 0;

        if ($startTime) {
            // Calculate the response time
            $duration = round(microtime(true) - $startTime, 4);
        }

        // Format the log output
        $time = date('Y-m-d H:i:s');
        $ipAddress = $request->ip();
        $url = $request->fullUrl();
        $method = $request->method();

        // Get request headers
        $reqHeaders = json_encode($request->headers->all(), JSON_UNESCAPED_SLASHES);

        // Get request body (params for GET/form-data, content for JSON)
        $reqParams = json_encode($request->except('user'), JSON_UNESCAPED_SLASHES);
        $reqContent = $request->getContent();

        // Get response body
        $resBody = $response->getContent();

        // Build the log message
        $logMessage = "-----------------------------\n";
        $logMessage .= "Time: {$time}\n";
        $logMessage .= "Duration: {$duration}\n";
        $logMessage .= "IP Address: {$ipAddress}\n";
        $logMessage .= "Url: {$url}\n";
        $logMessage .= "Method: {$method}\n";
        $logMessage .= "Req Header: {$reqHeaders}\n";
        $logMessage .= "Req Body (params): {$reqParams}\n";
        $logMessage .= "Req Body (content): \"{$reqContent}\"\n";
        $logMessage .= "Res: {$resBody}\n";

        // Write to log
        Log::channel('api')->info($logMessage);
    }
}
