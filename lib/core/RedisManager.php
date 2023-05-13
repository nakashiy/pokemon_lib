<?php

namespace pokemon_lib\core;

use pokemon_lib\core\RedisConnection;

/**
 * Redisを操作するクラス
 */
class RedisManager
{

    private $redis;
    const BASE_KEY = 'POKEMON_LIB';
    const POKEMON_KEY = self::BASE_KEY . ':pokemon';

    public function __construct()
    {
        $instance = RedisConnection::getInstance();
        $this->redis = $instance->connect('localhost');
    }
    public function get($key)
    {
        return json_decode($this->redis->get($key), true);
    }
    public function getArray($keys)
    {
        $result = [];
        foreach ($keys as $key) {
            $result[] = $this->get($key);
        }
        return $result;
    }
    public function set($key, $value)
    {
        return $this->redis->set($key, json_encode($value));
    }
    public function delete($keys)
    {
        return $this->redis->delete($keys);
    }
    public function hasKey($key)
    {
        return $this->redis->exists($key);
    }
    public function getAllKeys()
    {
        $keys = $this->redis->keys(self::BASE_KEY . '*');
        sort($keys);
        return $keys;
    }
    public function getPokemonKeys()
    {
        $keys = $this->redis->keys(self::POKEMON_KEY . '*');
        sort($keys);
        return $keys;
    }
}
