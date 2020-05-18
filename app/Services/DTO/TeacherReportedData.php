<?php
namespace App\Services\DTO;

use App\Grade;
use App\User;

class TeacherReportedData {
    public Grade $grade;
    public User  $teacher;
    public int   $activities_count;
    public int   $done_count;
    public int   $no_done_count;
    public array $students;

    public function __construct() {
    }
}
