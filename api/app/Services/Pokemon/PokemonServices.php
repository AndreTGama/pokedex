<?php

namespace App\Services\Pokemon;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class PokemonServices
{
    /**
     * @var PokemonApiServices An instance of the PokemonApiServices class used to interact with the Pokemon API.
     */
    protected PokemonApiServices $pokemonApiService;

    /**
     * PokemonServices constructor.
     *
     * @param PokemonApiServices $pokemonApiService An instance of the PokemonApiServices class
     *                                              used to interact with the Pokemon API.
     */
    public function __construct(PokemonApiServices $pokemonApiService)
    {
        $this->pokemonApiService = $pokemonApiService;
    }

    public function list(int $limit = 12, int $page = 1): array
    {
        $pokemons = [];

        $offset = ($page - 1) * $limit;
        $response = $this->pokemonApiService->call("pokemon?limit={$limit}&offset={$offset}", 'get');
        if ($response['error']) {
            throw ValidationException::withMessages([
                'message' => 'Error fetching Pokemon list',
                'error' => $response['message'],
            ]);
        }

        foreach ($response['data']['results'] as $key => $value) {
            $responsePokemon = $this->pokemonApiService->call('pokemon/' . $value['name'], 'get');
            $details = $responsePokemon['data'];

            if (!isset($details['id'])) {
                continue;
            }
            $pokemons[$key]['pokeapi_id'] = $details['id'];
            $pokemons[$key]['name'] = ucfirst($details['name']);
            $pokemons[$key]['height'] = $details['height'];
            $pokemons[$key]['weight'] = $details['weight'];
            $pokemons[$key]['abilities'] = array_map(function ($ability) {
                return ucfirst($ability['ability']['name']);
            }, $details['abilities']);
            $pokemons[$key]['stats'] = array_map(function ($stat) {
                return [
                    'name' => ucfirst($stat['stat']['name']),
                    'base_stat' => $stat['base_stat'],
                ];
            }, $details['stats']);
            $pokemons[$key]['moves'] = array_map(function ($move) {
                return ucfirst($move['move']['name']);
            }, $details['moves']);
            $pokemons[$key]['image'] = $details['sprites']['other']['showdown']['front_default'] ?? $details['sprites']['front_default'];
            $pokemons[$key]['types'] = array_map(function ($type) {
                return ucfirst($type['type']['name']);
            }, $details['types']);
        }

        return $pokemons;
    }
}
