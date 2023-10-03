<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Campo\CampoService;
use Illuminate\Support\Facades\Validator;

class CampoController extends Controller
{
    // Variaveis deste da Classe
    private $campoService;

    // Força o preenchimento ao chamar a classe
    public function __construct(CampoService $campoService)
    {
        $this->campoService = $campoService;
    }

    // Cadastrando novo campo
    public function create (Request $request)
    {
        // Campos de creterios de validação
        // required -> deixa o campo obrigatorio
        // string -> Defini o campo como um texto
        // Max e Min -> Range onde de caracteres min e max da resquest
        // Unique:tabeba,coluna -> Verifica se já existe um valor igual no banco de dados
        $rules = [
            'name' => 'required|string|min:0|max:120',
            'document' => 'required|string|min:11|max:15|unique:users,document',
            'phone_number' => 'required|max:15',
            'password' => 'required|min:8|max:255'
        ];

        // Mensagens no casos de erro
        $messages = [
            'name.required' => 'O campo nome é obrigatório',
            'phone_number.required' => 'O campo email é obrigatório',
            'phone_number.max' => 'Digite um numero valido',
            'document.required' => 'O campo CPF não foi preenchido',
            'document.min' => 'O campo CPF deve conter 11 caracteres',
            'document.unique' => 'Usuario já cadastrado',
            'password.min' => 'A senha deve conta no minimo 8 caracteres',
            'password.max' => 'A senha deve conta menos de 255 caracteres',
            'password.required' => 'O campo senha é obrigatório'
        ];
    }
}
