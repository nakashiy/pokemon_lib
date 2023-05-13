<?php
//==================================
// ポケモン情報のキャッシュをすべて削除
//==================================
require_once './../config/ini.php';

use pokemon_lib\core\RedisManager;

$RedisManager = new RedisManager();
$keys = $RedisManager->getPokemonKeys();
$RedisManager->delete($keys);
