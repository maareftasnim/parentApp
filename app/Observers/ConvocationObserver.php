<?php

namespace App\Observers;

use App\Models\Convocation;

class ConvocationObserver
{
    public function deleted(Convocation $convocation)
    {

        $convocation->etudiants()->delete();
    }
}
