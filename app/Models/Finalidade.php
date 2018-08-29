<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finalidade extends Model
{
    protected $table = 'finalidades';

    protected $fillable = ['finalidade'];

    public $timestamps = false;
}
