<?php

namespace App\Domain\Aluno;

class AlunoService
{
    private $alunoRepository;

    public function __construct(AlunoRepository $alunoRepository)
    {
        $this->alunoRepository = $alunoRepository;
    }

    public function insertAluno($nome, $email, $cpf)
    {
        $aluno = new Aluno(['nome' => $nome, 'email' => $email, 'cpf' => $cpf]);
        $this->alunoRepository->save($aluno);
    }

    public function getAluno()
    {
        return $this->alunoRepository->getAluno();
    }

    public function getAlunoById($id)
    {
        return $this->alunoRepository->getAlunoById($id);
    }

    public function deleteAluno($id)
    {
        $this->alunoRepository->deleteAluno($id);
    }

    public function updateAluno($nome, $email, $cpf, $id)
    {
        $aluno = (['nome' => $nome, 'email' => $email, 'cpf' => $cpf, 'id' => $id]);
        $this->alunoRepository->updateAluno($aluno);

    }

}
