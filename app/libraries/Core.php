<?php

// core app class
class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $currentParams = [];

    // create a constructor
    public function __construct()
    {
        $url = $this->getUrl();

        // check in controller folder for the first value
        // add file extension
        // using ucwords as every word in controllers will be capitalised
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            // set controller that is found to the current controller
            // to overwrite pages
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        // require the controller 
        require_once '../app/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;

        // statement to find next page of url
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) { // check in controller, then search for method at index 1
                // if method exists set current method to url[1]
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        // check if there is any parameters, if not leave it empty
        $this->params = $url ? array_values($url) : [];

        // return the array of parameters using callback
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }


    // get url
    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            // forbid non url characters
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // break url into array at each /
            $url = explode('/', $url);

            return $url;
        }
    }
}
