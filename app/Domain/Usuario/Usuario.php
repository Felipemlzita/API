<?php

namespace App\Domain\Usuario;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'users'; // Defina o nome da tabela corretamente
    protected $fillable = ['name', 'document', 'phone_number', 'password']; // Define as colunas
}
