<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class CachePageOutput
{
    public function handle($request, Closure $next)
    {
        if(env('APP_DEBUG')){
            return $next($request);
        }
        
        $isAjax = $request->ajax();
       
        $routeName = Route::currentRouteName();
        $params = $request->route()->parameters();
        $params = [
            ...$params,
            ...$request->query(),
            'is-ajax' => $isAjax,
        ];
        ksort($params);
        $paramsString = http_build_query($params);
        $cacheKey = "{$routeName}?{$paramsString}";
        $cachePath = storage_path("app/cache/pages/{$cacheKey}");

        // بررسی وجود فایل کش
        if (File::exists($cachePath)) {
            $content = File::get($cachePath);
            $mimeType = 'text/html';

            if (
                json_decode($content, true) !== null 
                && json_last_error() === JSON_ERROR_NONE
            ) {
                $mimeType = 'application/json';
            }

            return response($content, 200)
                ->header('Content-Type', $mimeType);
        }

        $response = $next($request);

        if ($response->getStatusCode() === 200) {
            $content = $response->getContent();
            $mimeType = $response->headers->get('Content-Type', 'text/html');

            if (
                json_decode($content, true)
                && json_last_error() === JSON_ERROR_NONE
            ) {
                $json = json_decode($content);
                if($json->page){
                    $htmlMin = new \Abordage\HtmlMin\HtmlMin();
                    $json->page = $htmlMin->minify($json->page);
                    $content = json_encode($json);
                }
            }elseif (str_contains($mimeType, 'text/html') !== false) {
                $htmlMin = new \Abordage\HtmlMin\HtmlMin();
                $content = $htmlMin->minify($content);
            } 
            
            File::ensureDirectoryExists(storage_path('app/cache/pages'));
            File::put($cachePath, $content);
        }

        return $response;
    }
}