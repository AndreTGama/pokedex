/* eslint-disable @next/next/no-img-element */
'use client'

import { typeColors } from "@/utils/constants";
import { PokemonResult } from "@/types/pokemon";
import Pokeball from "@/assets/img/pokeball.webp";

interface CardProps {
    pokemon: PokemonResult;
}

export function Card({ pokemon }: CardProps) {
    const types = pokemon.types.map((type, index) => {
        const typeKey = type.toLowerCase();
        const colorClass = typeColors[typeKey] || "bg-gray-300";
        return (
            <span
                key={index}
                className={`text-xs text-white px-2 py-1 rounded-full ${colorClass} mr-1`}
            >
                {type}
            </span>
        );
    });

    return (
        <div className="bg-gray-100 rounded-xl p-4 shadow-md flex flex-col items-center justify-between">
            <div className="relative flex justify-center w-1/3">
                <img
                    src={Pokeball.src}
                    alt="Pokeball background"
                    className="absolute w-28 h-28 opacity-10 animate-spin-slow top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-0"
                />
                <img
                    src={pokemon.image}
                    alt={pokemon.name}
                    className="w-20 h-20 object-contain mb-3 relative z-10"
                />
            </div>
            
            <div className="flex justify-center mb-2 flex-wrap relative z-10">
                {types}
            </div>

            <p className="text-sm text-gray-700 relative z-10 text-center">
                <span className="font-semibold">#{pokemon.pokeapi_id}</span> {pokemon.name.charAt(0).toUpperCase() + pokemon.name.slice(1)}
            </p>
        </div>
    );
}
