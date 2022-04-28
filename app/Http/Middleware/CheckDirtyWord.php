<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckDirtyWord
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
			$arrDirtyWords = ['apple','orange'];
			$parameters = $request->all();
			foreach ($parameters as $key => $value){
				if ($key == 'title'){
					foreach ($arrDirtyWords as $dirtyWords){
						if (strpos($value , $dirtyWords) !== false){
							return response('dirty!', 400);
						}
					}
				}
			}
        return $next($request);
    }
}
