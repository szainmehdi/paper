<?php namespace Paper\Http;

use Paper\Support\Collection;

class Request extends Collection {

    /**
     * @var string
     */
    protected $route;

    public function __construct()
    {
        $items = $this->getRequestData();
        parent::__construct($items);

        $this->route = $this->getCurrentRoute();
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    private function getRequestData()
    {
        // Fetch GET parameters.
        $items = array_merge($_GET, $_POST);

        return $items;
    }

    private function getCurrentRoute()
    {
        $uri = (!empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/');
        return clean_url($uri);
    }


}