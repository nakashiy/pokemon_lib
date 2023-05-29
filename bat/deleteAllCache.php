<?php
//==================================
// pokemon_libのキャッシュをすべて削除
//==================================
require_once './../config/ini.php';

use pokemon_lib\core\RedisManager;

$RedisManager = new RedisManager();
$keys = $RedisManager->getAllKeys();
$RedisManager->delete($keys);
