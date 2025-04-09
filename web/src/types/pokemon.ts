export type PokemonResult = {
  id: number;
  name: string;
  image: string;
  type: Array<string>;
};

export type PokemonListResponse = {
  data: PokemonResult[];
};
