<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'calendar'
    ];

    public function activities()
    {
        return $this->hasMany('App\Activity')->orderBy('published', "desc");
    }

    public function courses()
    {
        return $this->hasMany('App\Course')->orderBy('name', "asc");
    }

    public function students()
    {
        return $this->hasMany('App\User')->orderBy('name', "asc");
    }
}
