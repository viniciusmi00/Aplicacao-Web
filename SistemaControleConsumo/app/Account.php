<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //

    protected $fillable = [
         'predio_id', 'user_id', 'num_apartamento', 'month', 'year', 'consumo', 'dias_med', 'vencimento'
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
