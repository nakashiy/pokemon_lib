<?php
require_once './config/ini.php';

use pokemon_lib\manager\Pokemon;
use pokemon_lib\manager\PokemonSelect;

// for ($i = 1; $i <= 200; $i++) {
//     $Pokemon = new Pokemon($i);
//     $pokemons[] = $Pokemon->get();
// }
// console($pokemons);

$ids = [1,2,3,4,5,6,7,8,9];
$PokemonSelect = new PokemonSelect();
$pokemons = $PokemonSelect->orderHpStatus($ids);
console($pokemons);

// $i = 118;
// $Pokemon = new Pokemon($i);
// console($Pokemon->get());
