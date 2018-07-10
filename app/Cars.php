<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    protected $fillable = ['marka', 'model', 'rocznik', 'pojemnosc'];
}
