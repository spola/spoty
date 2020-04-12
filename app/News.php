<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class News extends Model
{
    use SoftDeletes;

    public static $TYPES = [
        'news' => 'Noticias',
        'birthday' => 'Cumpleaños',
        'activity' => 'Actividad',
    ];

    protected $fillable = [
        'title', 'description', 'published', 'content', 'grade_id', 'title_on_top', 'fixed_sized', 'type', 'entity', 'entity_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published'     => 'datetime',
        'title_on_top'  => 'boolean',
        'fixed_sized'   => 'boolean',
    ];

    public function grade()
    {
        return $this->belongsTo('App\Grade');
    }
}
