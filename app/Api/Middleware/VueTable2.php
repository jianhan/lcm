<?php

namespace App\Api\Http\Middleware;

use Closure;
use function in_array;
use function strtolower;

class VueTable2
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $input = $request->all();
        if (isset($input['sort']) && $arr = $this->isValidSort($input['sort'])) {
            $input['sortDir'] = $arr[1];
            $input['sortBy'] = $arr[0];
        }
        $request->replace($input);
        return $next($request);
    }

    /**
     * isValidSort determines if a sort is valid.
     *
     * @param string $value
     * @return bool|array
     */
    private function isValidSort(string $value)
    {
        $validDirArr = ['desc', 'asc'];
        $arr = explode('|', $value);
        if (sizeof($arr) == 2 && in_array(strtolower($arr[1]), $validDirArr)) {
            return $arr;
        }
        return false;
    }

}