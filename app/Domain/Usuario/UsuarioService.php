<?php

namespace App\Domain\Usuario;
use App\Domain\Usuario\UsuarioRepository;

class UsuarioService
{
    private $usuarioRepository;
    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }
    public function insert($name, $document, $phone_number, $password)
    {
        $aluno = new Usuario([
            'name' => $name,
            'document' => $document,
            'phone_number' => $phone_number,
            'password' => $password,
        ]);
        $this->usuarioRepository->save($aluno);
    }
    public function store()
    {
        return $this->usuarioRepository->store();
    }
    public function storeById($id)
    {
        return $this->usuarioRepository->storeById($id);
    }
    public function update ($id, $dadosUsuario)
    {
        $usuario = $this->usuarioRepository->update($id, $dadosUsuario);
        return $usuario;
    }
}
