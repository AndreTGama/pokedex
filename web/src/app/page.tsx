'use client'

import { useList } from '@/hooks/pokemon/useList'

export default function HomePage() {
  const { data, isLoading, error } = useList()

  if (isLoading) return <p>Carregando...</p>
  if (error) return <p>Erro ao carregar pokémons 😢</p>

  return (
    <div className="grid grid-cols-2 gap-4">
      {data?.map((pokemon) => (
        <div key={pokemon.name} className="p-4 bg-gray-100 rounded-xl shadow">
          {pokemon.name.toUpperCase()}
          <img src={pokemon.image} alt={pokemon.name} className="w-16 h-16" />
        </div>
      ))}
    </div>
  )
}
