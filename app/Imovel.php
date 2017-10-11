<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    protected $table = "imoveis";
    protected $fillable = ['numero', 'valor', 'dormitorio', 'suite', 'banheiros', 'garagem', 'mobilia', 'aservico',
        'descricao', 'aterreno', 'aconstruida', 'id_finalidade', 'id_tipo', 'id_rua'];
}
