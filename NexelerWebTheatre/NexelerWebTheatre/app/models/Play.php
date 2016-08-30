<?php

class Play
{
  var $playId;
  var $playTitle;
  var $description;
  
  public function __constuct($args)
    {
        $this->playId = $args["playId"];
        $this->playTitle = $args["playTitle"];
        $this->description = $args["description"];
    }
  
  public static function writeNewPlayInDatabase($playTitle,$description)
    {
        $database = Database::getInstance()->getConnection();

        $sql = "SELECT MAX ID FROM plays";
        $query_result = mysqli_query($database, $sql);

        $row = mysqli_fetch_array($query_result);
        $playId = $row + 1;

        $sql = "INSERT INTO plays (ID,Title,Description)
                    VALUES ('$playId','$playTitle','$description')";
        $query_result = mysqli_query($database, $sql);
        print_r($query_result);
        if ($query_result === TRUE) {
            return true;
        }
        return false;
    }
  
    public static function getPlayByID($play_id)
    {
        $dbConnection = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM plays where ID ='$play_id'";

        $result = mysqli_query($dbConnection,$sql);
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            
            $play= new Play($row);
            return $play;
        }

        return NULL;
    }
  
    public static function getPlayByName($play_name)  
    {
        $dbConnection = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM plays where Title ='$play_name'";

        $result = mysqli_query($dbConnection,$sql);
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            
            $play= new Play($row);
            return $play;
        }

        return NULL;
    
    }
    
    public static function fetchAllPlays()  
    {
        $dbConnection = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM plays";
        mysqli_query($dbConnection, "set names 'utf8'");
        $result = mysqli_query($dbConnection,$sql);
        if ($result->num_rows > 0)
        {
            return $result;
        }
        return NULL;
    }
    
    public static function deletePlayByID($play_id)
    {
        $database = Database::getInstance()->getConnection();
    	
    	$sql = "DELETE FROM play WHERE ID='$play_id'";
    	
        $query_result = $database->query($sql);
        if ($query_result === TRUE) {
            return true;
        }
        return false;
    }

    public static function getPlayPictureById($play_id)
    {
        $dbConnection = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM playpictures where PlayID ='$play_id'";

        $result = mysqli_query($dbConnection,$sql);
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            return $row['PlayPicture'];
        }
        return NULL;
    }

}
