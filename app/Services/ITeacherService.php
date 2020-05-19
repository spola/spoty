<?php

namespace App\Services;

use App\User;
use App\Grade;
use App\Services\DTO\TeacherReportedData;

use Illuminate\Database\Eloquent\Collection;

interface ITeacherService
{
    public function DailyReport(Grade $grade): TeacherReportedData;
}
