<?php

namespace App\Domain\Campo;
use App\Domain\Campo\CampoRepository;

class CampoService
{
    private $campoRepository;
    public function __construct(CampoRepository $campoRepository)
    {
        $this->campoRepository = $campoRepository;
    }
}
