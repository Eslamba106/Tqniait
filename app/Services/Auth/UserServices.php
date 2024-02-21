<?php 

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserServices 
{
    public function createUser($data):User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }
}







