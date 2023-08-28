<?php

namespace App\Domain\Aluno;
use App\Domain\Aluno\Aluno;

class EloquentAlunoRepository implements AlunoRepository
{
    public function save(Aluno $aluno)
    {
        $aluno->save();
    }

    public function getAluno()
    {
        return Aluno::all();
    }

    public function getAlunoById($id)
    {
        return Aluno::find($id);
    }

    public function deleteAluno($id)
    {
        $aluno =  Aluno::find($id);
        $aluno->delete();
    }

    public function updateAluno($aluno)
    {
        $recurso = Aluno::findOrFail($aluno['id']);
        $recurso->update($aluno);
    }
}
