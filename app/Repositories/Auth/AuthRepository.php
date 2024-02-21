<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Repositories\AbstractRepository;

class AuthRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

}
