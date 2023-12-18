<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CheckJsonPayload
{
    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return JsonResponse|RedirectResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse | RedirectResponse
    {
        $contentTypeHeader = $request->header('content-type');
        if ($contentTypeHeader != 'application/json') {
            return response()->json([
                'status'  => 'error',
                'message' => 'Please use json.'
            ], Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}