<?php

namespace App\Domain\Usuario;
use App\Domain\Usuario\Usuario;


interface UsuarioRepository
{
    public function save(Usuario $aluno);
    public function store();
    public function storeById($id);
    public function update ($id, $dadosUsuario);
}
