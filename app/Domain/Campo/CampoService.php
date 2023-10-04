<?php

namespace App\Domain\Campo;
use App\Domain\Campo\CampoRepository;
use App\Http\Controllers\APIAgro;
use App\Domain\Usuario\UsuarioService;

class CampoService
{
    private $campoRepository;
    private $usuarioService;

    public function __construct(CampoRepository $campoRepository)
    {
        $this->campoRepository = $campoRepository;
    }

    public function create ($name, $polygon, $user)
    {
        // Inicia a instancia da APIAgro
        $infoAgro = new APIAgro;
        $campo = $infoAgro->cadastroCampo($name, $polygon);
        $campoDecode = json_decode($campo);

        // Verifica se o campo foi cadastro caso não retorna o erro da APIAgro.
        if (empty($campoDecode->id)) {
            return json_encode(['message' => 'O cadastro não pode ser realizado', 'error' => [json_decode($campo)]]);
        }

        // Realiza o cadastro vinculando o campo ao usuario
        $campoCreate = new Campo([
            'user_id' => $user,
            'field_id' => $campoDecode->id
        ]);
        $this->campoRepository->save($campoCreate);

        return $campo;
    }

    public function store ()
    {
        $infoAgro = new APIAgro;
        $dados = $infoAgro->listarCampo();
        return $dados;
    }

}
