<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = "cidades";

    protected $fillable = ['cidade', 'id_estado'];

    public $timestamps = false;

    public function Estado()
    {
        return $this->belongsTo('App\Models\Estado', 'id_estado');
    }
}
