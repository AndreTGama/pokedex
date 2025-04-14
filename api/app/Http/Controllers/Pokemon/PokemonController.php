<?php

namespace App\Http\Controllers\Pokemon;

use App\Helpers\ReturnMessage;
use App\Http\Controllers\Controller;
use App\Models\Pokemon;
use App\Services\Pokemon\PokemonServices;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    protected $pokemonService;

    /**
     * PokemonController constructor.
     *
     * @param PokemonServices $pokemonService The service responsible for handling Pokémon-related operations.
     */
    public function __construct(PokemonServices $pokemonService)
    {
        $this->pokemonService = $pokemonService;
    }

    /**
     * List a paginated collection of Pokémon.
     *
     * @param int $limit The number of Pokémon to retrieve per page. Default is 12.
     * @param int $page The page number to retrieve. Default is 1.
     * 
     * @return \Illuminate\Http\JsonResponse A JSON response containing the Pokémon list or an error message.
     * 
     * @throws \Throwable If an error occurs during the retrieval process.
     */
    public function list(int $limit = 12, int $page = 1)
    {
        try {
            $limit = (int) $limit;
            $page = (int) $page;

            $data = $this->pokemonService->list($limit, $page);
            return ReturnMessage::success('Pokemon list', $data, 200);
        } catch (\Throwable $th) {
            return ReturnMessage::error('Error fetching Pokemon list', $th->getMessage(), [], 500);
        }
    }
}
