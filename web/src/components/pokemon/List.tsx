'use client'

import { useQuery } from '@tanstack/react-query'

const fetchPokemons = async () => {
  const res = await fetch('https://pokeapi.co/api/v2/pokemon?limit=151')
  return res.json()
}

export function List() {
  const { data, isLoading, error } = useQuery({
    queryKey: ['pokemons'],
    queryFn: fetchPokemons,
  })

  if (isLoading) return <p>Carregando...</p>
  if (error) return <p>Erro ao carregar Pokémons.</p>

  return (
    <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
      {data.results.map((pokemon: any, index: number) => (
        <div key={index} className="bg-gray-100 rounded-xl p-4 text-center shadow-md">
          <p className="capitalize font-bold">{pokemon.name}</p>
        </div>
      ))}
    </div>
  )
}
