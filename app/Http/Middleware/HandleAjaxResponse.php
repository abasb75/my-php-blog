<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class HandleAjaxResponse
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if (
            $request->ajax()
            && $response->original 
            && $response->original instanceof \Illuminate\View\View
        ) {
            
            // dd('11');
            $response = $response->original;
            $data = $response->getData();
            // dd($data);
            $title = $data['title'] ?? 'وب سایت شخصی عباس باقری';
            $content = View::make($response->name(), $data)->renderSections()['content'] ?? '';

            return response()->json([
                'result' => true,
                'page' => $content,
                'title' => $title,
            ]);

        }

        return $response;
    }
}