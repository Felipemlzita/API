<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Usuario\UsuarioService;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    // Variaveis deste da Classe
    private $usuarioService;

    // Força o preenchimento ao chamar a classe
    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    // Função para validação das informações do usuarios
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

        // Executa a validação no caso de creterio não atendido
        $validator =  Validator::make($request->all(), $rules, $messages);

        // Verifica se tiver erro retorna a API
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Enviando o usuario para registro no Banco de dados
        $this->usuarioService->insert($request->input('name'), $request->input('document'), $request->input('phone_number'), bcrypt($request->input('password')));
        return response()->json(['message' => 'Aluno cadastrado com sucesso'], 201);
    }

    // Função para geração da lista de usuarios
    public function store ()
    {
        $usuario = $this->usuarioService->store();
        return response()->json(['usuarios' => $usuario], 200);
    }

    // Função para busca de usuario por ID's
    public function storeById (Request $request)
    {
        // Busca o usuario pelo ID da request
        $usuario = $this->usuarioService->storeById($request->id);
        return response()->json(['usuario' => $usuario], 200);
    }

    // Função para atualizar as informações dos usarios
    public function update (Request $request, $id)
    {
        // Busca o usuario pelo ID da request
        $usuario = $this->usuarioService->storeById($request->id);

        // Valida se o usuario existe
        if(empty($usuario->id)){
            return ['message' => 'Usuário não encontrado.'];
        }

        // Valida as informações do request
        $rules = [
            'name' => 'required|string|min:0|max:120',
            'phone_number' => 'required|max:15'
        ];

        // Mensagens no casos de erro
        $messages = [
            'name.required' => 'O campo nome é obrigatório',
            'phone_number.required' => 'O campo email é obrigatório',
            'phone_number.max' => 'Digite um numero valido'
        ];

        // Executa a validação no caso de creterio não atendido
        $validator =  Validator::make($request->all(), $rules, $messages);

        // Verifica se tiver erro retorna a API
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dadosUsuario = $request->all();
        $this->usuarioService->update($id, $dadosUsuario);

        $usuario = $this->usuarioService->storeById($id);
        return $usuario;
    }
}
