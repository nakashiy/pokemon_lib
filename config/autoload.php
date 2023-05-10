<?php
/**
 * 必要なクラスを必要な時に自動でローディングする。
 * pokemon_lib/libをルートディレクトリ(名前空間：pokemon_lib)として、ディレクトリ構造に対応した名前空間をつけること。
 * 
 * ex.) pokemon_lib/lib/controller ディレクトリ配下のクラスは下記の名前空間とする
 *        namespace pokemon_lib\controller;
 */
spl_autoload_register(function($class) {
    $prefix = 'pokemon_lib\\';

    if (strpos($class, $prefix) === 0) {
        $className = substr($class, strlen($prefix));
        $classFilePath = __DIR__ . '/../lib/' . str_replace('\\', '/', $className) . '.php';

        if (file_exists($classFilePath)) {
            require $classFilePath;
        }
    }
});
