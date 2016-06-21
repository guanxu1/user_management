<?php

namespace App\Http\Middleware;
use Closure;
class AllowOrigin
{

    public function handle($request, Closure $next) {

        $this->getModules();
        return $next($request);
    }



    public function getModules() {




    }



}
