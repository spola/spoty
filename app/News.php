<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class News extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'published', 'content', 'grade_id', 'title_on_top', 'fixed_sized'
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
