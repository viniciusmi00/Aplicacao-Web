<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'telefone1', 'telefone2', 'num_apartamento', 'qnt_pessoas', 'password', 'predio_id', 'access_level' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function building() {
        return $this->belongsTo(Building::class);
    }

    public function buildings() {
        return $this->belongsToMany('App\Building', 'users_buildings', 'user_id, predio_id')->withTimestamps();
    }

}
