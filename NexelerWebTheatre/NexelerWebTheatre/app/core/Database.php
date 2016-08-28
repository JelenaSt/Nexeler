<?php
/**
 * Database short summary.
 *
 * Database description.
 *
 * @version 1.0
 * @author Jelena
 */

require_once(dirname(__FILE__)."\..\config\database.config.php");
class Database
{
    private $_connection;
	private static $_instance; //The single instance
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $database = DB_NAME;
    var $num_active_users;   //Number of active users viewing site
    var $num_active_guests;  //Number of active guests viewing site
    var $num_members;        //Number of signed-up users

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

         $this->num_members = -1;
    }

    private function connect_mysql(){
        
        $this->_connection = new mysqli(Config::get('DB_HOST'),Config::get('DB_USER'),Config::get('DB_PASSWORD'),Config::get('DB_NAME'));
        // Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conenct to to MySQL: " . mysqli_connect_error(), E_USER_ERROR);
        }

    }

 

    public function getConnection() {
		return $this->_connection;
	}

}

