<?php
/**
 * Support library of helper methods.
 */

if(!function_exists('dd')) {
    function dd(...$vars) {
        var_dump(...$vars);
        die();
    }
}

if(!function_exists('root_path')) {
    function root_path() {
        return dirname(__DIR__);
    }
}

if(!function_exists('path_to')) {
    function path_to($dir, $append = null) {
        $dir = root_path() . '/' . $dir;

        if(!is_null($append)) {
            $dir .= '/' . $append;
        }

        return $dir;
    }
}

if(!function_exists('config_path')) {

    function config_path($path = null) {

        return path_to('config', $path);

    }
}

if(!function_exists('src_path')) {

    function src_path($path = null) {

        return path_to('src', $path);

    }
}

if(!function_exists('array_get')) {
    function array_get($array, $key) {
        if(array_key_exists($key, $array)) {
            return $array[$key];
        } else {
            $keys = explode('.', $key);

            if(array_key_exists($k = array_shift($keys), $array)) {
                return array_get($array[$k], implode('.', $keys));
            } else {
                return null;
            }
        }
    }
}

if(!function_exists('clean_url')) {
    function clean_url($uri) {
        $slashes = '/\\';
        return ltrim(rtrim($uri, $slashes), $slashes);
    }
}