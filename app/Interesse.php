<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interesse extends Model
{
    protected $table='interesses';

    protected $fillable = ['nome','telefone','email','atendido','id_imovel'];
}
