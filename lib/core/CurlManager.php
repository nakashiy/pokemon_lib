<?php

namespace pokemon_lib\core;

use Exception;

class CurlManager
{
    public function __construct()
    { }

    public function exec($url)
    {
        try {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //https対策
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //文字列で返す
            curl_setopt($curl, CURLOPT_TIMEOUT, 10); //タイムアウト時間(秒)
            $curl_json = curl_exec($curl);
            // curl_close($curl);
            return json_decode($curl_json, true);
        } catch (Exception $e) {
            throw new Exception("Curl実行に失敗しました。:" . mb_convert_encoding($e->getMessage(), 'utf-8', 'sjis'));
        }
    }
}
