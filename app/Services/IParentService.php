<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Collection;

interface IParentService
{
    public function land(User $user): array;

    public function week(User $user): array;
}
