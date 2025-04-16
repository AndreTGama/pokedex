import { useQuery } from '@tanstack/react-query'
import { HookListResponse } from '@/types/pokemon'
import axios from 'axios'
import { usePokemon } from '@/providers/PokemonProvider';

const baseUrl = 'http://127.0.0.1:8000/api';

export function useList(limit = 12, page = 1) {

  const { setPokemons } = usePokemon()
  return useQuery({
    queryKey: ['pokemonList', limit],
    queryFn: async () => {
      const { data } = await axios.get<HookListResponse>(
        `${baseUrl}/pokemon/${limit}/${page}`
      )
      setPokemons(data.data.pokemons)
      return data.data.pokemons
    },
  })
}
