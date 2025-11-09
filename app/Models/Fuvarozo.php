<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Fuvarozo extends Authenticatable
{
    protected $table = 'fuvarozo';
    use Notifiable;

    protected $fillable = ['nev','email','jelszo'];
    protected $hidden = ['jelszo'];

    public function jarmuvek() {
        return $this->hasOne(Jarmu::class);
    }

    public function munkak() {
        return $this->hasMany(Munka::class);
    }
}
