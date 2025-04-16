export type PokemonResult = {
  pokeapi_id: number;
  name: string;
  image: string;
  types: Array<string>;
};

export type PokemonListResponse = {
  total: number;
  pages: number;
  current_page: number;
  limit: number;
  pokemons: PokemonResult[];
  next_page: number | null;
  prev_page: number | null;
  last_page: number;
};

export type HookListResponse = {
  message: string;
  data: PokemonListResponse;
  exception: string | null;
  error: boolean;
}
