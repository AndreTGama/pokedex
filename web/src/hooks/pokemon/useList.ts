import { useQuery } from '@tanstack/react-query'
import { PokemonListResponse } from '@/types/pokemon'
import axios from 'axios'

const baseUrl = 'http://127.0.0.1:8000/api';

export function useList(limit = 12, page = 1) {
  return useQuery({
    queryKey: ['pokemonList', limit],
    queryFn: async () => {
      const { data } = await axios.get<PokemonListResponse>(
        `${baseUrl}/pokemon/${limit}/${page}`
      )

      return data.data
    },
  })
}
