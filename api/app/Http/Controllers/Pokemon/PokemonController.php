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
    public function __construct(PokemonServices $pokemonService)
    {
        $this->pokemonService = $pokemonService;
    }

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
