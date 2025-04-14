export type PokemonResult = {
  pokeapi_id: number;
  name: string;
  image: string;
  types: Array<string>;
};

export type PokemonListResponse = {
  data: PokemonResult[];
};
