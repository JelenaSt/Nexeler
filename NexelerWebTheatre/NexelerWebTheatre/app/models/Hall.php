<?php

/**
 * Hall short summary.
 *
 * Hall description.
 *
 * @version 1.0
 * @author Jelena
 */
class Hall
{
    var $hall_id;
    var $hall_name;
    var $capacity;

    function __construct($args){
        $this->hall_id = $args['hall_id'];
        $this->hall_name = $args['hall_name']; 
        $this->capacity = $args['capacity']; 
    }

    public static function fetchAllHalls(){
        $database = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM halls;";
       	
        $result = $database->query($sql);

        if(!$result){
            return false;
        }

        $array=$result->fetch_all(MYSQLI_ASSOC);
        return $array;
    }
    public static function gettHallById($id)
    {
        $database = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM halls 
				WHERE hall_id ='$id'";
        
        mysqli_query($database, "set names 'utf8'");	
        $result = mysqli_query($database,$sql);
        
       
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
           
            $hall= new Hall($row);
            return $hall;
        }
        return NULL;
    }

    
    public static function getHallNameByID($hall_id)
    {
        $hall = self::gettHallById($hall_id);
        return $hall->hall_name;
    }


}