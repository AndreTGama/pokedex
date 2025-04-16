'use client'

import { Card } from '../card/Card'
import { useList } from '@/hooks/pokemon/useList'
import { PokemonResult } from '@/types/pokemon'

export function List() {
  const { data, isLoading, error } = useList()

  if (isLoading) return <p>Carregando...</p>
  if (error) return <p>Erro ao carregar pokémons 😢</p>

  return (
    <div className="grid grid-cols-3 gap-4">
      {data?.map((pokemon: PokemonResult) => (
        <Card key={pokemon.pokeapi_id} pokemon={pokemon} />
      ))}
    </div>
  )
}
