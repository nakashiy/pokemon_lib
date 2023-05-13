<?php

namespace pokemon_lib\core;

use Exception;
use Redis;

/**
 * Redis接続を行うクラス
 */
class RedisConnection
{

    private static $instance;
    private static $connections;

    public function __destruct()
    {
        if (!empty(self::$connections)) {
            foreach (self::$connections as $conn) {
                $conn->close();
            }
        }
    }

    final public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new RedisConnection();
        }
        return self::$instance;
    }

    /**
     * Redisへのコネクションを生成する。
     * @param type $servername サーバー名
     * @return type
     */
    public function connect($servername = 'localhost', $port = 6379)
    {
        if (isset(self::$connections[$servername]) && self::$connections[$servername]->isConnected() == "1") {
            return self::$connections[$servername];
        }

        // 指定されたRedis接続情報がない場合、接続処理を行う
        $host = '';
        switch ($servername) {
            case 'localhost':
                $host = 'localhost';
                break;
            default:
                $host = 'localhost';
        }

        // redisコネクションの生成
        try {
            $Redis = new Redis();
            $Redis->connect($host, $port);
            self::$connections[$servername] = $Redis;
            return self::$connections[$servername];
        } catch (Exception $e) {
            throw new Exception("Redis接続に失敗しました。:" . mb_convert_encoding($e->getMessage(), 'utf-8', 'sjis'));
        }
    }

    public function close($servername = 'localhost')
    {
        self::$connections[$servername]->close();
    }
}
