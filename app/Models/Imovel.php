<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    protected $table = "imoveis";

    protected $fillable = ['numero', 'valor', 'dormitorio', 'suite', 'banheiro', 'garagem', 'mobilia', 'aservico',
        'descricao', 'aterreno', 'aconstruida', 'id_finalidade', 'id_tipo', 'id_rua'];

    public $timestamps = false;

    public function Rua()
    {
        return $this->belongsTo('App\Models\Rua', 'id_rua');
    }

    public function Finalidade()
    {
        return $this->belongsTo('App\Models\Finalidade', 'id_finalidade');
    }

    public function Tipo()
    {
        return $this->belongsTo('App\Models\Tipo', 'id_tipo');
    }

    public function Foto()
    {
        return $this->hasMany('App\Models\Foto', 'id_imovel');
    }
}
