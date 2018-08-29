<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rua extends Model
{
    protected $table = 'ruas';

    protected $fillable = ['cep', 'rua', 'id_bairro'];

    public $timestamps = false;

    public function Bairro()
    {
        return $this->belongsTo('App\Models\Bairro', 'id_bairro');
    }
}
