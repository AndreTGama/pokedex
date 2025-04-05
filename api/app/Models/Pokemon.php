<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pokemon extends Model
{
    use SoftDeletes, HasUuids;

    protected $table = 'pokemons';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The $fillable property specifies the attributes that are mass assignable.
     * 
     * @var array $fillable
     * 
     * @property int $pokeapi_id The unique identifier for the Pokémon from the PokeAPI.
     * @property string $name The name of the Pokémon.
     * @property string $sprite The URL or path to the Pokémon's sprite image.
     * @property array $types The types associated with the Pokémon (e.g., Fire, Water).
     * @property array $stats The stats of the Pokémon (e.g., HP, Attack, Defense).
     * @property array $abilities The abilities of the Pokémon.
     * @property array $moves The moves that the Pokémon can learn.
     * @property int $height The height of the Pokémon in decimeters.
     * @property int $weight The weight of the Pokémon in hectograms.
     */
    protected $fillable = [
        'pokeapi_id',
        'name',
        'sprite',
        'types',
        'stats',
        'abilities',
        'moves',
        'height',
        'weight'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     * 
     * - 'types': Casts the 'types' attribute to an array.
     * - 'stats': Casts the 'stats' attribute to an array.
     * - 'abilities': Casts the 'abilities' attribute to an array.
     * - 'moves': Casts the 'moves' attribute to an array.
     */
    protected $casts = [
        'types' => 'array',
        'stats' => 'array',
        'abilities' => 'array',
        'moves' => 'array',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     * 
     * - 'deleted_at': Casts the attribute to a datetime instance.
     * - 'created_at': Casts the attribute to a datetime instance.
     * - 'updated_at': Casts the attribute to a datetime instance.
     */
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
