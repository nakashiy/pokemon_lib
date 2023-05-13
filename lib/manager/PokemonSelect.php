<?php

namespace pokemon_lib\manager;

use pokemon_lib\manager\Pokemon;
use pokemon_lib\core\RedisManager;

/**
 * 条件を指定してポケモン情報を取得するクラス
 */
class PokemonSelect
{
    public function __construct()
    { }

    /**
     * 単体の情報を取得（キャッシュになければAPIで取得）
     * $id int ポケモンID
     * @return array
     */
    public function single($id)
    {
        $Pokemon = new Pokemon($id);
        return $Pokemon->get();
    }
    /**
     * 複数の情報を取得（キャッシュになければAPIで取得）
     * $ids array ポケモンID
     * @return array
     */
    public function multi($ids)
    {
        $pokemons = [];
        foreach ($ids as $id) {
            $Pokemon = new Pokemon($id);
            $pokemons[] = $Pokemon->get();
        }
        return $pokemons;
    }
    /**
     * すべての情報を取得（キャッシュのみから取得）
     * @return array
     */
    public function all()
    {
        $RedisManager = new RedisManager();
        $redis_keys = $RedisManager->getAllKeys();
        return $RedisManager->getArray($redis_keys);
    }

    /**
     * 名前で検索（キャッシュのみから取得）
     * $str string 検索文字
     * @return array
     */
    public function whereName($str, $operator = 'like')
    {
        $RedisManager = new RedisManager();
        $redis_keys = $RedisManager->getPokemonKeys();
        $pokemons = $RedisManager->getArray($redis_keys);
        foreach ($pokemons as $pokemon) {
            if (strpos($pokemon['name']['ja'], $str) !== false) {
                $result[] = $pokemon;
            }
        }
        return $result;
    }

    /**
     * 合計ステータスで並び替えて取得（キャッシュのみから取得）
     * $ids array ポケモンID
     * @return array ポケモン情報
     */
    public function orderTotalStatus($ids, $order = SORT_DESC)
    {
        $pokemons = $this->multi($ids);
        foreach ($pokemons as $pokemon) {
            $key_first[] = $pokemon['status_total'];
            $key_second[] = $pokemon['id'];
        }
        array_multisort($key_first, $order, SORT_NUMERIC, $key_second, SORT_ASC, SORT_NUMERIC, $pokemons);
        return $pokemons;
    }
    /**
     * HPステータスで並び替えて取得（キャッシュのみから取得）
     * $ids array ポケモンID
     * @return array ポケモン情報
     */
    public function orderHpStatus($ids, $order = SORT_DESC)
    {
        $pokemons = $this->multi($ids);
        foreach ($pokemons as $pokemon) {
            $key_first[] = $pokemon['status']['hp'];
            $key_second[] = $pokemon['id'];
        }
        array_multisort($key_first, $order, SORT_NUMERIC, $key_second, SORT_ASC, SORT_NUMERIC, $pokemons);
        return $pokemons;
    }
    /**
     * 攻撃ステータスで並び替えて取得（キャッシュのみから取得）
     * $ids array ポケモンID
     * @return array ポケモン情報
     */
    public function orderAttackStatus($ids, $order = SORT_DESC)
    {
        $pokemons = $this->multi($ids);
        foreach ($pokemons as $pokemon) {
            $key_first[] = $pokemon['status']['attack'];
            $key_second[] = $pokemon['id'];
        }
        array_multisort($key_first, $order, SORT_NUMERIC, $key_second, SORT_ASC, SORT_NUMERIC, $pokemons);
        return $pokemons;
    }
}
