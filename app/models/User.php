<?php

class User
{

    // create db must be private
    private $db;

    public function __construct()
    {
        // instantiate db property
        $this->db = new Database;
    }

    public function register($data)
    {
        // add register data to db
        $this->db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');

        // bind the values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // finally execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password)
    {
        // get all usernames from user table 
        $this->db->query('SELECT * FROM users WHERE username = :username');

        // bind the values
        $this->db->bind(':username', $username);

        // find a single row 
        $row = $this->db->single();

        // check that hashed password is equal to the entered password
        $hashedPassword = $row->password;

        // built in password_verify used to unhash password
        if (password_verify($password, $hashedPassword)) {
            // return the specific row if a match
            return $row;
        } else {
            return false;
        }
    }

    // method for finding users by email
    public function findUserByEmail($email)
    {
        // email = prepared statement for email
        $this->db->query('SELECT * FROM users WHERE email = :email');

        // must bind email parameter with the $email variable
        $this->db->bind(':email', $email);

        // Check if the row count is greater than zero
        // thus checking if email is already registered
        if ($this->db->rowCount() > 0) { // note that rowCount was defined in Database library
            return true;
        } else {
            return false;
        }
    }

    // 
    public function getUsers()
    {
        // get all info from table users
        $this->db->query("SELECT * FROM users");

        // store the the result in resultSet()
        // resultSet stores everything in an array
        $result = $this->db->resultSet();
    }
}
