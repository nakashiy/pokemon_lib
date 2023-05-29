<?php
//==================================
// ポケモン情報をキャッシュ
//==================================
require_once __DIR__ . '/../config/ini.php';

use pokemon_lib\manager\PokemonSelect;
use pokemon_lib\core\Logger;

$Logger = Logger::getInstance();
$Logger->info('ポケモン情報のキャッシュを開始します。');

$start = $argv[1];
$end = $argv[2];

$ids = range($start, $end);
$PokemonSelect = new PokemonSelect();
$pokemons = $PokemonSelect->multi($ids);

$Logger->info("ポケモン情報のキャッシュを終了しました。\n開始：No.${start}、終了：No.${end}");
