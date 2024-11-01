<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInfoRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function SayHello()
    {
        return 'morning';
    }
    public function store(UserInfoRequest $userInfoRequest)
    {
        User::create($userInfoRequest->all());
    }
}
