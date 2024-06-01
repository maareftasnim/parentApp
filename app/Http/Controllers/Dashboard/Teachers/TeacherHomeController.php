<?php

namespace App\Http\Controllers\Dashboard\Teachers;

use App\Http\Controllers\Controller;

class TeacherHomeController extends Controller
{
    public function index()
    {
        $user = auth('teachers')->user();
        // return $user->firstname;
        $message = "Bonjour " . $user->firstname;
        return $message;
    }
}
