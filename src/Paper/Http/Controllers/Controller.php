<?php namespace Paper\Http\Controllers;

use Paper\Http\Request;

abstract class Controller {

    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request) {

        $this->request = $request;
    }

}