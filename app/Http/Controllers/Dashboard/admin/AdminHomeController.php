<?php

namespace App\Http\Controllers\Dashboard\admin;

use App\Http\Controllers\Controller;

class AdminHomeController extends Controller
{
        public function index()
        {
            $user = auth('admin')->user();
           // return $user->firstname;
            $message = "Bonjour " . $user->firstname;
            return $message;
        }
}
