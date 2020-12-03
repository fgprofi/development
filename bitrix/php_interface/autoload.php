<?php
/**
 * Created by PhpStorm.
 * User: Garret
 * Date: 12.10.2017
 * Time: 21:50
 */

spl_autoload_register(function($className) {

    $libDirs = array(
        $_SERVER['DOCUMENT_ROOT'] . '/bitrix/php_interface/lib',
    );


    foreach ($libDirs as $libDir) {
        $checkPaths = array(
            $libDir . '/' . str_replace('\\', '/', $className) . '.php',
            $libDir . '/' . str_replace('\\', '/', strtolower($className)) . '.php',
        );

        foreach ($checkPaths as $classFile) {
            if (file_exists($classFile) && is_readable($classFile)) {
                require_once $classFile;
                return;
            }
        }
    }
    if (! class_exists($className)) {
    }
});