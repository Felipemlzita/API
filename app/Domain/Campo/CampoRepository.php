<?php

namespace App\Domain\Campo;
use App\Domain\Campo\Campo;


interface CampoRepository
{
    public function save (Campo $campo);
}
