<?php

namespace pokemon_lib\core;

use Exception;
use pokemon_lib\core\RedisConnection;

/**
 * Redisを操作するクラス
 */
class RedisManager {

    private $redis;
    const BASE_KEY = 'POKEMON_LIB';
    const POKEMON_KEY = self::BASE_KEY . ':pokemon';

    public function __construct() {
        $instance = RedisConnection::getInstance();
        $this->redis = $instance->connect('localhost');
    }
    public function get($key) {
        return json_decode($this->redis->get($key), true);
    }
    public function set($key, $value) {
        return $this->redis->set($key, json_encode($value));
    }
    public function allKeys() {
        $keys = $this->redis->keys(self::BASE_KEY . '*');
        sort($keys);
        return $keys;
    }
    public function pokemonKeys() {
        $keys = $this->redis->keys(self::POKEMON_KEY . '*');
        sort($keys);
        return $keys;
    }

}
