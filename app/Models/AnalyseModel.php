<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalyseModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'analyses';

    protected $fillable = ['repository'];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
