<?php namespace Paper\Foundation;

use Paper\Contracts\Foundation\Application as ApplicationContract;
use Paper\Http\Request;
use Paper\Http\Router;

class Application implements ApplicationContract {

    const VERSION = '0.1-alpha';

    /**
     * @var \Paper\Foundation\Configuration
     */
    public $configuration;
    protected $request;
    protected $router;


    public function __construct() {

        $this->configuration = new Configuration();
        $this->request = new Request();
        $this->router = new Router($this);

        $this->registerRoutesFile();

    }

    public function getRouter()
    {
        return $this->router;
    }

    public function run()
    {
        return $this->router->run($this->request);
    }

    private function registerRoutesFile()
    {
        $router = $this->router;
        require $this->configuration->get('app.routes');
    }

}