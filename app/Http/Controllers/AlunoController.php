<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Aluno\AlunoService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Domain\Aluno\Aluno;


class AlunoController extends Controller
{
    //
    private $alunoService;

    public function __construct(AlunoService $alunoService)
    {
        $this->alunoService = $alunoService;
    }

    public function insertAluno(Request $request)
    {
        $rules = [
            'nome' => 'required|string',
            'cpf' => 'required|string|min:11|max:15',
            'email' => 'required|email|unique:alunos,email'
        ];

        $messages = [
            'nome.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Insira um endereço de email válido.',
            'email.unique' => 'Este email já está em uso por outro aluno.',
            'cpf.required' => 'O campo CPF não foi preenchido',
            'cpf.min' => 'O campo CPF deve conter 11 caracteres'
        ];

        $validator =  Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        $this->alunoService->insertAluno($request->input('nome'), $request->input('email'), $request->input('cpf'));
        return response()->json(['message' => 'Aluno cadastrado com sucesso'], 201);
    }

    public function getAluno()
    {
        $allAlunos = $this->alunoService->getAluno();
        return response()->json(["alunos" => $allAlunos]);
    }

    public function getAlunoById($id){
        $selectAluno = $this->alunoService->getAlunoById($id);
        if(isset($selectAluno)){
            return response()->json($selectAluno);
        }
        return response()->json(["errors" => "Aluno não encontrado"], 400);
    }

    public function deleteAluno($id)
    {
        $aluno =  Aluno::find($id);
        if (!$aluno) {
            return response()->json(['message' => 'Aluno não encontrado'], 404);
        }
        $this->alunoService->deleteAluno($id);
        return response()->json(['message' => 'Aluno deletado com sucesso']);
    }

    public function updateAluno(Request $request, $id)
    {
        $rules = [
            'nome' => 'required|string',
            'cpf' => 'required|string|min:11|max:15',
            'email' => 'required|email|unique:alunos,email'
        ];

        $messages = [
            'nome.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Insira um endereço de email válido.',
            'email.unique' => 'Este email já está em uso por outro aluno.',
            'cpf.required' => 'O campo CPF não foi preenchido',
            'cpf.min' => 'O campo CPF deve conter 11 caracteres'
        ];
        $validator =  Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $this->alunoService->updateAluno($request->input('nome'), $request->input('email'), $request->input('cpf'), $id);
        return response()->json(['message' => 'Aluno atualizado com sucesso'], 200);
    }
}
