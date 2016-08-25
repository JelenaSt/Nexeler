<?php

/**
 * Database short summary.
 *
 * Database description.
 *
 * @version 1.0
 * @author Jelena
 */
class Database
{
    private $_connection;
	private static $_instance; //The single instance
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $database = DB_NAME;

    /*
	Get an instance of the Database
	@return Instance
     */
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}

    private function __construct()
    {
        $this->connect_mysql();
    }

    private function connect_mysql(){
        
        //$db_handle = mysql_connect($this->_host, $this->_username, 
        //    $this->_password);
        //$this->_connection = mysql_select_db($this->database,$db_handle);

        $this->_connection = new mysqli($this->host, $this->user, 
           $this->password,$this->database);
        // Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conenc to to MySQL: " . mysqli_connect_error(), E_USER_ERROR);
		}

        echo 'Database connected!';

    }

    public function getConnection() {
		return $this->_connection;
	}

}