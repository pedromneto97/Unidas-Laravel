<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bairro extends Model
{
    protected $table = 'bairros';

    protected $fillable = ['bairro', 'id_cidade'];

    public function Cidade()
    {
        return $this->belongsTo('App\Cidade', 'id_cidade');
    }
}
