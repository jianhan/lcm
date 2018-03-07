<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Course extends Model implements HasMedia
{

    use SoftDeletes, HasMediaTrait;

    protected $with = ['categories'];

    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'visible' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start',
        'end',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static function validationRules(): array
    {
        return [
            'course.name' => [
                'required',
                Rule::unique('courses', 'name')
            ],
            'course.slug' => [
                'required',
                Rule::unique('courses', 'slug'),
                'regex:' . \Config::get('constants.slug_regex'),
            ],
            'course.description' => 'required|max:1024',
            'course.visible' => 'boolean',
            'course.start' => 'required|date_format:"Y-m-d H:i:s"',
            'course.end' => 'required|date_format:"Y-m-d H:i:s"',
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'course.name.required' => 'A name is required',
            'course.name.unique' => 'Course name must be unique',
            'course.slug.unique' => 'Course slug must be unique',
            'course.slug.required' => 'A slug is required',
            'course.start.regex' => 'Invalid start date format',
            'course.end.regex' => 'Invalid end date format',
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
