'use client';

import { ReactNode, createContext, useContext, useState } from 'react';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { PokemonResult } from '@/types/pokemon';

interface PokemonContextType {
  pokemons: PokemonResult[];
  setPokemons: React.Dispatch<React.SetStateAction<PokemonResult[]>>;
  pokemon: PokemonResult | null;
  setPokemon: React.Dispatch<React.SetStateAction<PokemonResult | null>>;
}

// eslint-disable-next-line @typescript-eslint/no-explicit-any
const PokemonContext = createContext<any>(null);

const queryClient = new QueryClient();

export function PokemonProvider({ children }: { children: ReactNode }) {
  const [pokemons, setPokemons] = useState<PokemonResult[]>([]);
  const [pokemon, setPokemon] = useState<PokemonResult | null>(null);


  const value: PokemonContextType = {
    pokemons,
    setPokemons,
    pokemon,
    setPokemon,
  };

  return (
    <PokemonContext.Provider value={value}>
      <QueryClientProvider client={queryClient}>{children}</QueryClientProvider>
    </PokemonContext.Provider>
  );
}

export function usePokemon() {
  const context = useContext(PokemonContext);
  if (!context) {
    throw new Error('usePokemon deve ser usado dentro de um PokemonProvider');
  }
  return context;
}