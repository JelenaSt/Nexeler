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


    function __construct()
    {
        $this->connect_mysql();
    }

    private function connect_mysql(){
        
        $db_handle = mysql_connect($this->_host, $this->_username, 
			$this->_password);
        $this->_connection = mysql_select_db($this->database,$db_handle);

        // Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysqli_connect_error(), E_USER_ERROR);
		}

    }

    public function getConnection() {
		return $this->_connection;
	}

}