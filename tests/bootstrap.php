<?php
spl_autoload_register(
    function ($class) {
        if (0 === strpos(ltrim($class, '/'), 'OORL')) {
            if (file_exists($file = dirname(__DIR__).'/src/'.str_replace('\\', '/', $class).'.php')) {
                require_once $file;
            }
        }
    }
);
