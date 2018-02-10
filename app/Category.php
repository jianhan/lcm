<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;

    protected $with = ['courses'];

    /**
     * The roles that belong to the user.
     */
    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }
}
