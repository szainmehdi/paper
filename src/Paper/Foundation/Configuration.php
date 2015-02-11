<?php namespace Paper\Foundation;

use Paper\Support\Collection;

class Configuration extends Collection {

    public function __construct()
    {
        $items = $this->load();
        parent::__construct($items);
    }

    private function load()
    {
        $config = [];
        foreach(glob(config_path('*.php')) as $file) {
            $config[basename($file, '.php')] =  include $file;
        }
        return $config;
    }

}