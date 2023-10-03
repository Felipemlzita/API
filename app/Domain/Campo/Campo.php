<?php

namespace App\Domain\Campo;

use Illuminate\Database\Eloquent\Model;

class Campo extends Model
{
    protected $table = 'user_fields'; // Defina o nome da tabela corretamente
    protected $fillable = ['user_id', 'field_id']; // Define as colunas
}
