<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PokemonTrainer extends Model
{
    use HasUuids, SoftDeletes;

    protected $table = 'pokemons_trainers';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The $fillable property specifies the attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trainer_id',
        'pokemon_id',
        'created_at',
        'updated_at',
    ];
    
}
