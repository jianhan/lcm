<?php

namespace App\Api\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class TimeParser extends TransformsRequest
{
    /**
     * Transform the given value.
     *
     * @param  string $key
     * @param  mixed $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        if (preg_match(\Config::get('constants.api.date_format_regex'), $value)) {
            return Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $value)->toDateTimeString();
        }
        return $value;
    }

}
