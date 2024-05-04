<?php

namespace Tungnt\CKEditor;

use Closure;

class CKFinderMiddleware
{
    public function handle($request, Closure $next)
    {
        config(['ckfinder.authentication' => function() use ($request) {

            return true;
        }] );

        return $next($request);
    }
}
