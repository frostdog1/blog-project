<?php


class Post
{
    // database property only to be used for Post class
    private $db;

    // constructor
    public function __construct()
    {
        // call $db everytime Post.php model is called
        $this->db = new Database;
    }

    // read all posts from the4 database
    public function findAllPosts()
    {
        // use query to get all posts in ascending order according to time of creation
        $this->db->query('SELECT * FROM posts ORDER BY created_at ASC');

        // due to possibility of returning multiple rows,
        // return an array instead of string by using resultSet()
        $results = $this->db->resultSet();

        // return array results
        return $results;
    }

    public function findPostById($id)
    {
        $this->db->query('SELECT * FROM posts WHERE id = :id');

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    // take entire data array and insert post
    public function addPost($data)
    {
        $this->db->query('INSERT INTO posts (user_id, title, body) VALUES (:user_id, :title, :body)');

        // bind these values
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        // if it can be exectuted return true 
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePost($data)
    {
        $this->db->query('UPDATE posts SET title = :title body = :body WHERE id = :id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePost($id)
    {
        $this->db->query('DELETE FROM posts WHERE id = :id');

        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
