<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Course extends Model
{

    use SoftDeletes;

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
            'name' => [
                'required',
                Rule::unique('courses', 'name')
            ],
            'slug' => [
                'required',
                Rule::unique('courses', 'slug'),
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            ],
            'description' => 'required|max:1024',
            'visible' => 'boolean',
            'start' => 'required|date_format:"Y-m-d H:i:s"',
            'end' => 'required|date_format:"Y-m-d H:i:s"',
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
