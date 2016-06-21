<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\ParameterBag;
use App\Utils\HttpUtil;
use App\Utils\ContantUtil;

class ParseRequestJson
{
    /**
     * 将请求中的json参数变为常规请求参数.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//     	$isJson = $request->isJson();
//     	if ($isJson === false) {
//             return HttpUtil::getRespone(['status'=>ContantUtil::$FAILURE, 'msg'=>trans('messages.request_must_be_json')]);		
//     	}
    	$jsonParam = $request->json()->all();
    	foreach ($jsonParam as $k=>$v) {
    		$request->request->set($k, $v);
    	}
        return $next($request);
    }
    
    
}
