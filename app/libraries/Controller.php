<?php

// this controller class defines the model and view
class Controller
{
    // method for loading the models
    public function model($model)
    {
        // ../app/models/User.php as example
        require_once '../app/models/' . $model . '.php';

        // Instantiate the model
        return new $model();
    }

    // method for loading the models
    public function view($view, $data = [])
    {
        // check for the views file
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die("View does not exist.");
        }
    }
}
