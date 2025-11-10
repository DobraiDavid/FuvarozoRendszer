<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Fuvarozo extends Authenticatable
{
    protected $table = 'fuvarozo';
    use Notifiable;

    protected $fillable = ['nev','email','jelszo'];
    protected $hidden = ['jelszo', 'remember_token'];

    public function getAuthPassword()
    {
        return $this->jelszo;
    }

    public function jarmu() {
        return $this->hasOne(Jarmu::class);
    }

    public function munkak() {
        return $this->hasMany(Munka::class);
    }
}