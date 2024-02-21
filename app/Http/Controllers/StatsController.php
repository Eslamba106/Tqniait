<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function stats(){
        $numberOfAllUsers = User::count();
        $numberOfAllPosts = Post::count();
        $numberOfAllUsersWithoutPosts = User::whereDoesntHave('posts')->count();
        return response()->apiSuccess(
            "number of all users is " . $numberOfAllUsers .
            "        number of all posts is ". $numberOfAllPosts .
            "        number of all users without posts is " .$numberOfAllUsersWithoutPosts
            , $numberOfAllUsersWithoutPosts);
    }
}
