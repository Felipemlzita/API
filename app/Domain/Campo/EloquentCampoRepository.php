<?php

namespace App\Domain\Campo;
use App\Domain\Campo\Campo;

class EloquentCampoRepository implements CampoRepository
{
    public function save (Campo $campo)
    {
        $campo->save();
    }
}
