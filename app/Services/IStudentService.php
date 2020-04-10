<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

interface IStudentService
{
    //function distribucionCargaEjecutivos(int $id) : Collection;

    public function land($user);
}
