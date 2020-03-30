<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Course extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'icon', 'grade_id', 'content', 'teacher_name', 'teacher_email', 'teacher_phone'
    ];

    public function grade()
    {
        return $this->belongsTo('App\Grade');
    }

    public function activities()
    {
        return $this->hasMany('App\Activity')->orderBy('published', "desc");
    }
}
