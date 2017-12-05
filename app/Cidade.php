<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = "cidades";

    protected $fillable = ['cidade', 'id_estado'];

    public $timestamps = false;

    public function Estado()
    {
        return $this->belongsTo('App\Estado', 'id_estado');
    }
}
