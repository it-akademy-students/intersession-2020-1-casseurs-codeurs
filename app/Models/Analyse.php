<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analyse extends Model
{
    protected $fillable = ['repository'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
