<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    protected $table = "imoveis";
    protected $fillable = ['numero', 'valor', 'dormitorio', 'suite', 'banheiro', 'garagem', 'mobilia', 'aservico',
        'descricao', 'aterreno', 'aconstruida', 'id_finalidade', 'id_tipo', 'id_rua'];

    public function Rua()
    {
        return $this->belongsTo('App\Rua', 'id_rua');
    }

    public function Finalidade()
    {
        return $this->belongsTo('App\Finalidade', 'id_finalidade');
    }

    public function Tipo()
    {
        return $this->belongsTo('App\Tipo', 'id_tipo');
    }

    public function Foto()
    {
        return $this->hasMany('App\Foto', 'id_imovel');
    }
}
