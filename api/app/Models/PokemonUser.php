<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PokemonUser extends Model
{
    use HasUuids, SoftDeletes;

    protected $table = 'pokemons_users';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The $fillable property specifies the attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'pokemon_id',
        'created_at',
        'updated_at',
    ];
    
}
