<?php

namespace App\Services\Pokemon;

use Illuminate\Support\Facades\Http;

class PokemonApiServices
{
    /**
     * @var string $baseUrl
     * The base URL for the Pokémon API (PokeAPI).
     * This URL is used as the starting point for all API requests.
     */
    protected string $baseUrl = 'https://pokeapi.co/api/v2/';

    public function call(string $endpoint, string $method = 'GET', array $params = []): array
    {
        $url = $this->baseUrl . ltrim($endpoint, '/');

        try {
            if (strtolower($method) === 'get') {
                $response = Http::get($url);
            } else {
                $response = Http::{$method}($url, $params);
            }

            if ($response->successful()) {
                return [
                    'error' => false,
                    'status' => $response->status(),
                    'data' => $response->json(),
                ];
            }

            return [
                'error' => true,
                'status' => $response->status(),
                'message' => $response->body(),
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}
