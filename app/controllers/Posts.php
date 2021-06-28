<?php

// inherit from core controller
class Posts extends Controller
{
    // main goal is that every time controller is called,
    // an action will be performed to the model which will read data
    public function __construct()
    {

        $this->postModel = $this->model('Post');
    }

    // define the view
    public function index()
    {
        // get all available blog posts
        $posts = $this->postModel->FindAllPosts();

        // create array for passing posts to view
        $data = [
            // key of posts assigned to all blog posts
            'posts' => $posts
        ];

        // add data array as second arguemnt
        // to print out inside the view
        // must loop thru $data array (posts/index.php)
        $this->view('posts/index', $data);
    }

    // handle post creation
    public function create()
    {

        // if user is not logged in redirect to posts
        if (!isLoggedIn()) {
            header("location: " . URLROOT . "/posts");
        }

        $data = [
            'title' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
        ];

        // check if form has been submitted or not
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize form data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'titleError' => '',
                'bodyError' => ''
            ];

            // ensure forms are not empty
            if (empty($data['title'])) {
                $data['titleError'] = 'The title of a post cannot be empty';
            }

            if (empty($data['body'])) {
                $data['bodyError'] = 'The body of a post cannot be empty';
            }

            // ensure error messages are empty to continue on
            if (empty($data['titleError']) && empty($data['bodyError'])) {
                if ($this->postModel->addPost($data)) {
                    // redirect user to all the blog posts, with theirs at the top
                    header("Location: " . URLROOT . "/posts");
                } else {
                    // if error messages are empty return general error msg
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->view('posts/create', $data);
            }
        }

        $this->view('posts/create', $data);
    }

    // handle post updates
    public function update($id)
    {

        // passing in specific id of the post
        $post = $this->postModel->findPostById($id);

        // ensure that only the creator of a post can updatea blog post
        if (!isLoggedIn()) {
            header("Location: " . URLROOT . "/posts");
        } elseif ($post->user_id != $_SESSION['user_id']) {
            header("Location: " . URLROOT . "/posts");
        }

        $data = [
            'post' => $post,
            'title' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
        ];

        // sanitize the data
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'post' => $post,
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'titleError' => '',
                'bodyError' => ''
            ];

            if (empty($data['title'])) {
                $data['titleError'] = 'The title of a post cannot be empty';
            }

            if (empty($data['body'])) {
                $data['bodyError'] = 'The body of a post cannot be empty';
            }

            if ($data['title'] == $this->postModel->findPostById($id)->title) {
                $data['titleError'] == 'At least change the title!';
            }

            if ($data['body'] == $this->postModel->findPostById($id)->body) {
                $data['bodyError'] == 'At least change the body!';
            }

            if ($data['post']->title == $this->postModel->findPostById($id)->title) {
                $data['titleError'] == 'Change title';
            }

            if ($data['post']->title == $this->postModel->findPostById($id)->title) {
                $data['bodyError'] == 'Change body';
            }

            if (empty($data['titleError']) && empty($data['bodyError'])) {
                if ($this->postModel->updatePost($data)) {
                    header("Location: " . URLROOT . "/posts");
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->view('posts/update', $data);
            }
        }

        $this->view('posts/update', $data);
    }

    // handle post deletion
    public function delete($id)
    {
        // works similar to update function
        $post = $this->postModel->findPostById($id);

        if (!isLoggedIn()) {
            header("Location: " . URLROOT . "/posts");
        } elseif ($post->user_id != $_SESSION['user_id']) {
            header("Location: " . URLROOT . "/posts");
        }

        $data = [
            'post' => $post,
            'title' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if ($this->postModel->deletePost($id)) {
                header("Location: " . URLROOT . "/posts");
            } else {
                die('Something went wrong!');
            }
        }
    }
}
