<?php
//==================================
// ポケモン情報をキャッシュ
//==================================
require_once './../config/ini.php';

use pokemon_lib\manager\PokemonSelect;

$start = filter_input(INPUT_GET, 'start', FILTER_VALIDATE_INT);
$end = filter_input(INPUT_GET, 'end', FILTER_VALIDATE_INT);

if (!$start || !$end) {
    echo '引数が正しくありません。';
}

$ids = range($start, $end);
$PokemonSelect = new PokemonSelect();
$pokemons = $PokemonSelect->multi($ids);
