<?php
// model and view methods accessible to Pages class
class Pages extends Controller
{
    public function __construct()
    {
        // instantiate new model User
        $this->userModel = $this->model('User');
    }

    // default page 
    public function index()
    {
        $users = $this->userModel->getUsers();
        $data = [
            'title' => 'Home Page',
            'users' => '$users'
        ];

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $this->view('pages/about');
    }
}
