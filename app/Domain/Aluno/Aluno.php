<?php

namespace App\Domain\Aluno;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = ['nome', 'email', 'cpf'];
}


