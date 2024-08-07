<?php 

require_once("new_config.php");

class Database {

    private $connection;

    function __construct()
    {
        $this -> open_db_connection();
    }

    public function get_connection()
    {
        if($this -> connection)
        {
            return true;
        }
        return false;
    }

    public function open_db_connection()
    {
        
        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if($this->connection->connect_errno){
            die("Database connection failed" . $this->connection->connect_error);
        }
    }

    public function query($sql) 
    {

        $result = $this->connection->query($sql);

        return $result; 
    }

    private function confirm_query($result)
    {
        if(!$result)
        {
            die("Query failed" . $this->connection->error);
        }
    }

    public function escape_string($string)
    {
        $escaped_string = $this->connection->real_escape_string($string);
        return $escaped_string;
    }
    
    public function the_insert_id() 
    {
        return $this->connection->insert_id;
    }
}

//Connecting with the database
$database = new Database();

?>