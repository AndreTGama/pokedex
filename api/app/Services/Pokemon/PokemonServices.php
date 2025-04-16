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

    /**
     * Retrieves a paginated list of Pokémon with their details.
     *
     * @param int $limit The number of Pokémon to retrieve per page. Default is 12.
     * @param int $page The current page number. Default is 1.
     * 
     * @return array An array containing the paginated Pokémon data:
     *               - 'total' (int): Total number of Pokémon available.
     *               - 'pages' (int): Total number of pages.
     *               - 'current_page' (int): The current page number.
     *               - 'limit' (int): The number of Pokémon per page.
     *               - 'pokemons' (array): List of Pokémon with their details:
     *                   - 'pokeapi_id' (int): The Pokémon's ID from the API.
     *                   - 'name' (string): The Pokémon's name (capitalized).
     *                   - 'height' (int): The Pokémon's height.
     *                   - 'weight' (int): The Pokémon's weight.
     *                   - 'abilities' (array): List of the Pokémon's abilities (capitalized).
     *                   - 'stats' (array): List of the Pokémon's stats:
     *                       - 'name' (string): The stat name (capitalized).
     *                       - 'base_stat' (int): The base value of the stat.
     *                   - 'moves' (array): List of the Pokémon's moves (capitalized).
     *                   - 'image' (string|null): URL of the Pokémon's image.
     *                   - 'types' (array): List of the Pokémon's types (capitalized).
     *               - 'next_page' (int|null): The next page number, or null if on the last page.
     *               - 'prev_page' (int|null): The previous page number, or null if on the first page.
     *               - 'last_page' (int): The last page number.
     * 
     * @throws \Illuminate\Validation\ValidationException If there is an error fetching the Pokémon list.
     */
    public function list(int $limit = 12, int $page = 1): array
    {
        $data = [];
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

        $pages = (int)ceil($response['data']['count'] / $limit);

        $data['total'] = $response['data']['count'];
        $data['pages'] = $pages;
        $data['current_page'] = $page;
        $data['limit'] = $limit;
        $data['pokemons'] = $pokemons;
        $data['next_page'] = $page < $pages ? $page + 1 : null;
        $data['prev_page'] = $page > 1 ? $page - 1 : null;
        $data['last_page'] = $pages;
 
        return $data;
    }
}
