<?php

namespace App\Services;

use App\User;
use Illuminate\Database\Eloquent\Collection;

interface IParentService
{
    public function land(User $user): array;
}
