<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Domain\Campo\CampoService;
use App\Domain\Usuario\UsuarioService;


class CampoController extends Controller
{
    // Variaveis deste da Classe
    private $campoService;
    private $usuarioService;

    // Força o preenchimento ao chamar a classe
    public function __construct(CampoService $campoService, UsuarioService $usuarioService)
    {
        $this->campoService = $campoService;
        $this->usuarioService = $usuarioService;
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
            'polygon' => 'required|string',
            'user' => 'required'
        ];

        // Mensagens no casos de erro
        $messages = [
            'name.required' => 'O campo nome é obrigatório',
            'polygon.required' => 'O campo polygon é obrigatório',
            'user.required' => 'O campo usuário é obrigatório'
        ];

        // Executa a validação no caso de creterio não atendido
        $validator =  Validator::make($request->all(), $rules, $messages);

        // Verifica se tiver erro retorna a API
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Busca o usuario pelo ID da request
        $usuario = $this->usuarioService->storeById($request->user);

        // Verifica se existe um usuario com o ID
        if (empty($usuario->id)) {
            return $usuario;
        }

        // Inicia o cadastro do campo
        $retorno = json_decode($this->campoService->create($request->name, $request->polygon, $request->user));

        // Verifica se o campo foi cadastro caso não retorna o erro da APIAgro.
        if (empty($retorno->id)) {
            return response()->json($retorno, 400);
        }

        return $retorno;
    }

    // Listando todos os campos
    public function store ()
    {
        $dados = $this->campoService->store();
        return response()->json([json_decode($dados)], 200);
    }

    // Lista
    public function storeById ()
    {

    }
}
