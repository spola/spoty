<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_student', 'grade_id', 'is_parent', 'is_grade_admin', 'is_superadmin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_student' => 'boolean',
        'is_grade_admin' => 'boolean',
        'is_parent' => 'boolean',
        'is_superadmin' => 'boolean',
    ];

    public function grade()
    {
        return $this->belongsTo('App\Grade');
    }


    public function childrens()
    {
        return $this->belongsToMany('App\User', 'student_parent', 'parent_id', 'student_id')->withTimestamps();;
    }

    public function parents()
    {
        return $this->belongsToMany('App\User', 'student_parent', 'student_id', 'parent_id')->withTimestamps();;
    }

    public function adminGrades()
    {
        return $this->belongsToMany('App\Grade', 'admin_grades', 'user_id', 'grade_id')->withTimestamps();;
    }
}
