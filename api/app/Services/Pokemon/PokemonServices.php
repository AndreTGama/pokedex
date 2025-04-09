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
            $pokemons[$key]['id'] = $details['id'];
            $pokemons[$key]['name'] = ucfirst($details['name']);
            $pokemons[$key]['image'] = $details['sprites']['other']['showdown']['front_default'] ?? $details['sprites']['front_default'];
            $pokemons[$key]['types'] = array_map(function ($type) {
                return ucfirst($type['type']['name']);
            }, $details['types']);
        }

        return $pokemons;
    }
}
