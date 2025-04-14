'use client'

import { useList } from '@/hooks/pokemon/useList'
import { Card } from '@/components/card/Card'

export default function HomePage() {
  const { data, isLoading, error } = useList()

  if (isLoading) return <p>Carregando...</p>
  if (error) return <p>Erro ao carregar pokémons 😢</p>

  return (
    <div className="grid grid-cols-3 gap-4">
      {data?.map((pokemon) => (
        <Card key={pokemon.pokeapi_id} pokemon={pokemon} />
      ))}
    </div>
  )
}
