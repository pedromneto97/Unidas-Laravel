<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rua extends Model
{
    protected $table = 'ruas';

    protected $fillable = ['cep','rua','id_bairro'];
}
