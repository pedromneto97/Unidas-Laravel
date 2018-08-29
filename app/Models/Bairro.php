<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bairro extends Model
{
    protected $table = 'bairros';

    protected $fillable = ['bairro', 'id_cidade'];
    public $timestamps = false;

    public function Cidade()
    {
        return $this->belongsTo('App\Models\Cidade', 'id_cidade');
    }
}
