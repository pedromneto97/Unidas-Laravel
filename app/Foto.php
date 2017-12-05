<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'fotos';

    protected $fillable = ['foto', 'id_imovel'];

    public $timestamps = false;
}
