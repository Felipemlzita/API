<?php

namespace App\Domain\Usuario;
use App\Domain\Usuario\Usuario;

class EloquentUsuarioRepository implements UsuarioRepository
{
    public function save(Usuario $usuario)
    {
        $usuario->save();
    }
    public function store()
    {
        return Usuario::all();
    }
    public function storeById($id)
    {
        $usuario = Usuario::find($id);

        // Verifica se existe um usuario com o ID
        if ($usuario == null) {
            return ['message' => 'Usuário não encontrado.'];
        }
        return $usuario;
    }
    public function update ($id, $dadosUsuario)
    {
        $usuario = Usuario::find($id);
        $usuario->update($dadosUsuario);
        return $usuario;
    }
}
