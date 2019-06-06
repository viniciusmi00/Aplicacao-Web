<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = 'buildings';
    protected $primaryKey = 'id';

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'nomePredio', 'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'municipio', 'uf',
    ];

    
    public function user()
    {
        return $this ->belongsTO(User::class);
    }
    
    public function usuarios() {
        return $this->hasMany(User::class);
    }
}
