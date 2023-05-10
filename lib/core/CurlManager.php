<?php

namespace pokemon_lib\core;

class CurlManager
{
    public function __construct()
    { }

    public function execCurl($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_json = curl_exec($curl);
        // curl_close($curl);
        return json_decode($curl_json, true);
    }
}
