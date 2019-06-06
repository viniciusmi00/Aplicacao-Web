<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        'predio_id', 'baixo', 'medio', 'alto', 'meta', 'faixa', 'valor',
    ];

    
    public function user()
    {
        return $this ->belongsTO(User::class);
    }
    
    public function usuarios() {
        return $this->hasMany(User::class);
    }
}

