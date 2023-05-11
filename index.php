<?php
require_once './config/ini.php';

// use pokemon_lib\manager\Pokemon;
use pokemon_lib\manager\PokemonSelect;

$PokemonSelect = new PokemonSelect();

//for ($i = 1; $i <= 151; $i++) {
//    $pokemons[] = $PokemonSelect->single($i);
//}
//console($pokemons);

//$ids = [1,2,3,4,5,6,7,8,9];
//$pokemons = $PokemonSelect->orderAttackStatus($ids);
//console($pokemons);

$i = 2000;
console($PokemonSelect->single($i));

//$RedisManager = new RedisManager();
//console($RedisManager->pokemonKeys());

//console($PokemonSelect->whereName('ア'));
