<?php

namespace App\Domain\Aluno;
use App\Domain\Aluno\Aluno;


interface AlunoRepository
{
    public function save(Aluno $aluno);
    public function getAluno();
    public function getAlunoById($id);
    public function deleteAluno($id);
    public function updateAluno($aluno);
}

