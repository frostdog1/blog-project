<?php
// create a connection to the database

class Database
{
    // set database properties
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    // for prepared statement
    private $statement;
    // when prepared statement used dbHandler required 
    private $dbHandler;

    private $error;

    // run connection to database whenever database.php is called
    public function __construct()
    {
        // make use of prepared statements so that when someone logs in, 
        // bind input fields to database information
        $connect = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;

        $options = array(
            // prevent driver crashing or timing out whilst connecting to db
            PDO::ATTR_PERSISTENT => true,
            // handle errors 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION

        );
        try {

            $this->dbHandler = new PDO($connect, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // method that allows creation of queries
    public function query($sql)
    {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    // bind params with value
    public function bind($parameter, $value, $type = null)
    {
        // check $type is null
        switch (is_null($type)) {

                // check if value is int
            case is_int($value):
                // if so set type to int
                $type = PDO::PARAM_INT;
                break;
                // check if value is boolean
            case is_bool($value):
                // if so set type to boolean
                $type = PDO::PARAM_BOOL;
                break;
                // check if value is null
            case is_null($value):
                // if so set type to null
                $type = PDO::PARAM_NULL;
                break;
            default;
                $type = PDO::PARAM_STR;
        }
        // set the parameter value and type
        $this->statement->bindValue($parameter, $value, $type);
    }

    // method to execute prepared statement
    public function execute()
    {
        return $this->statement->execute();
    }

    // return an array
    public function resultSet()
    {
        $this->execute();
        // return the fetched object
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    // return one single row
    public function single()
    {
        $this->execute();
        // just fetch instead of fetchAll
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    // count the number of rows
    public function rowCount()
    {
        // count the number of rows when a query is updated
        return $this->statement->rowCount();
    }
}
