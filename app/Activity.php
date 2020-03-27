<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'due_date', 'link', 'course_id', 'new_tab'
    ];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'due_date' => 'datetime',
        'new_tab' => 'boolean',
    ];



    public function course()
    {
        return $this->belongsTo('App\Course');
    } 
}
