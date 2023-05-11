<?php

namespace pokemon_lib\manager;

use pokemon_lib\core\CurlManager;
use pokemon_lib\core\RedisManager;

/**
 * ポケモン1体の情報を操作するクラス
 */
class Pokemon
{
    private const BASE_URL = 'https://pokeapi.co/api/v2/';
    private const URL_PARAMS = [
        'pokemon', //基本情報
        'pokemon-species' //種族情報
    ];
    private $id; //ポケモンID
    private $info; //ポケモン情報
    private $cache; //Redisキャッシュ

    // IDから情報を取得
    public function __construct($id)
    {
        $this->id = $id;
        // RedisにキャッシュがあればAPIを実行しない
        $RedisManager = new RedisManager;
        $redis_key = $RedisManager::POKEMON_KEY . ':' . sprintf('%04d', $this->id);
        $this->cache = $RedisManager->get($redis_key);
        if (!empty($this->cache)) return;

        // APIでポケモン情報取得
        $CurlManager = new CurlManager();
        foreach (self::URL_PARAMS as $url_param) {
            $url = self::BASE_URL . $url_param . '/' . $this->id . '/';
            $result[$url_param] = $CurlManager->execCurl($url);
        }
        // console($result);
        if (!$result['pokemon'] && !$result['pokemon-species']) return;
        // 取得結果から使用する情報を設定
        $this->setName($result);
        $this->setStatus($result);
        $this->setText($result);
        $this->info['id'] = $result['pokemon']['id'];
        $this->info['weight'] = $result['pokemon']['weight'];
        $this->info['height'] = $result['pokemon']['height'];
        $this->info['img_url'] = 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/' . $this->id . '.png';
        $RedisManager->set($redis_key, $this->info);
        $this->cache = $RedisManager->get($redis_key);
    }

    // ポケモン情報取得
    public function get()
    {
        return $this->cache;
    }

    /**
     * 名前(日本語)をセット
     * $result array API取得情報
     */
    private function setName($result)
    {
        foreach ($result['pokemon-species']['names'] as $name) {
            switch ($name['language']['name']) {
                case 'ja-Hrkt':
                    $this->info['name']['ja-Hrkt'] = $name['name'];
                    break;
                case 'ja':
                    $this->info['name']['ja'] = $name['name'];
                    break;
            }
        }
    }
    /**
     * ステータスをセット
     * $result array API取得情報
     */
    private function setStatus($result)
    {
        $total = 0;
        foreach ($result['pokemon']['stats'] as $stat) {
            $this->info['status'][$stat['stat']['name']] = $stat['base_stat'];
            $total += $stat['base_stat'];
        }
        $this->info['status_total'] = $total;
    }
    /**
     * 説明文(日本語)をセット
     * $result array API取得情報
     */
    private function setText($result)
    {
        foreach ($result['pokemon-species']['flavor_text_entries'] as $flavor_text) {
            switch ($flavor_text['language']['name']) {
                case 'ja-Hrkt':
                    $this->info['flavor_text']['ja-Hrkt'][$flavor_text['version']['name']] = $flavor_text['flavor_text'];
                    break;
                case 'ja':
                    $this->info['flavor_text']['ja'][$flavor_text['version']['name']] = $flavor_text['flavor_text'];
                    break;
            }
        }
    }
}
