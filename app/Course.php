<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{

    use SoftDeletes;

    protected $with = ['categories'];

    protected $guarded = ['id'];

    public static function validationRules(): array
    {
        return [
            'name' => 'required|unique:courses,name',
            'slug' => 'required|alpha_dash|unique:courses,slug',
            'description' => 'required|max:1024',
            'start' => 'required|regex:' . \Config::get('constants.api.date_format_regex'),
            'end' => 'required|regex:' . \Config::get('constants.api.date_format_regex'),
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'name.required' => 'A name is required',
            'name.unique' => 'Course name must be unique',
            'slug.required' => 'A slug is required',
            'start.regex' => 'Invalid start date format',
            'end.regex' => 'Invalid end date format',
        ];
    }

    /**
     * The roles that belong to the user.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
