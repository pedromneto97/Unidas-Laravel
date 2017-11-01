<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rua extends Model
{
    protected $table = 'ruas';

    protected $fillable = ['cep', 'rua', 'id_bairro'];

    public function Bairro()
    {
        return $this->belongsTo('App\Bairro', 'id_bairro');
    }
}
