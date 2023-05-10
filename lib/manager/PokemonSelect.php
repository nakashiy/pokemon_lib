<?php

namespace pokemon_lib\manager;

use pokemon_lib\manager\Pokemon;

// ポケモンAPIを利用するクラス
class PokemonSelect
{
    public function __construct()
    { }

    /**
     * 合計ステータスで並び替えて取得
     * $ids array ポケモンID
     * @return array ポケモン情報
     */
    public function orderTotalStatus($ids, $order = SORT_DESC)
    {
        $pokemons = [];
        foreach ($ids as $id) {
            $Pokemon = new Pokemon($id);
            $pokemons[] = $Pokemon->get();
        }
        foreach ($pokemons as $pokemon) {
            $status_array[] = $pokemon['status_total'];
            $id_array[] = $pokemon['id'];
        }
        array_multisort($status_array, $order, SORT_NUMERIC, $id_array, SORT_ASC, SORT_NUMERIC, $pokemons);
        return $pokemons;
    }
    /**
     * HPステータスで並び替えて取得
     * $ids array ポケモンID
     * @return array ポケモン情報
     */
    public function orderHpStatus($ids, $order = SORT_DESC)
    {
        $pokemons = [];
        foreach ($ids as $id) {
            $Pokemon = new Pokemon($id);
            $pokemons[] = $Pokemon->get();
        }
        foreach ($pokemons as $pokemon) {
            $status_array[] = $pokemon['status']['hp'];
            $id_array[] = $pokemon['id'];
        }
        array_multisort($status_array, $order, SORT_NUMERIC, $id_array, SORT_ASC, SORT_NUMERIC, $pokemons);
        return $pokemons;
    }
    /**
     * 攻撃ステータスで並び替えて取得
     * $ids array ポケモンID
     * @return array ポケモン情報
     */
    public function orderAttackStatus($ids, $order = SORT_DESC)
    {
        $pokemons = [];
        foreach ($ids as $id) {
            $Pokemon = new Pokemon($id);
            $pokemons[] = $Pokemon->get();
        }
        foreach ($pokemons as $pokemon) {
            $status_array[] = $pokemon['status']['attack'];
            $id_array[] = $pokemon['id'];
        }
        array_multisort($status_array, $order, SORT_NUMERIC, $id_array, SORT_ASC, SORT_NUMERIC, $pokemons);
        return $pokemons;
    }
}
