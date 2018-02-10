<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{

    use SoftDeletes;

    protected $with = ['categories'];

    /**
     * The roles that belong to the user.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
