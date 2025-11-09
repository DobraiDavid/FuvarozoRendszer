<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Munka extends Model
{
    protected $table = 'munka';
    protected $fillable = ['indulas','erkezes','cimzett_neve','cimzett_telefonszama','status','fuvarozo_id'];

    public function fuvarozo() {
        return $this->belongsTo(Fuvarozo::class);
    }
}
