<?php

namespace App\Api\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class CourseTransformer extends TransformerAbstract
{
    public function transform(\App\Course $course)
    {
        return [
            'id' => $course->id,
            'name' => $course->name,
            'slug' => $course->slug,
            'description' => $course->description,
            'visible' => $course->visible,
            'start' => Carbon::createFromFormat('Y-m-d H:i:s', $course->start)->format(\Config::get('constants.api.date_format_iso_8600')),
            'end' => Carbon::createFromFormat('Y-m-d H:i:s', $course->end)->format(\Config::get('constants.api.date_format_iso_8600')),
        ];
    }
}
