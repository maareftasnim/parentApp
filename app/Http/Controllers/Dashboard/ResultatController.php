<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Resultat;

class ResultatController extends Controller
{
    public function index()
    {

        $resultat = Resultat::get();

        return view('Quiz.Resultat.show', compact('resultat'));

    }
}
