<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    public static $TYPES = [
        'file' => 'Archivos',
        'video' => 'Video',
        'link' => 'Enlace',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'due_date', 'link', 'course_id', 'new_tab', 'published', 'type', 'scored'
    ];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'due_date' => 'datetime',
        'published' => 'datetime',
        'new_tab' => 'boolean',
        'scored' => 'boolean',
    ];

    protected $attributes = [
        'new_tab' => true,
    ];


    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
