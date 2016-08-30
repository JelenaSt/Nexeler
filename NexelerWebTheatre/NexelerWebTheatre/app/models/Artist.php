<?php

class Artist
{
  var $artistId;
  var $artistName;
  var $artistBiography;
  
  //kako se stvarno zovu kolone tamo, bem li ga
  public function __construct($args)
  {
    $this->artistId = $args["ID"];
    $this->artistName = $args["Name"];
    $this->artistBiography = $args["Biography"];
  }
  
  public static function writeNewActorInDatabase($actorName,$actorBio)
  {
    $database = Database::getInstance()->getConnection();
    $sql = "SELECT MAX ID 
            FROM artists";
    $query_result = mysqli_query($database, $sql);
    $row = mysqli_fetch_array($query_result);
    
    $artistId = $row + 1;
    $sql = "INSERT INTO artists (ID,Name,Biography)
            VALUES ('$artistId','$actorName','$actorBio')";
    $query_result = mysqli_query($database, $sql);
    print_r($query_result);
    if ($query_result === TRUE) 
    {
      return true;
    }
    return false;
  }
  
  public static function updateActor($actor_id,$actor_name,$actor_desc)
  {
    $database = Database::getInstance()->getConnection();
    
    $sql = "UPDATE artists SET Name='$actor_name', Biography='$actor_desc'
            WHERE ID='$actor_id'";
            
    $query_result = $database->query($sql);
    
    if ($query_result === TRUE) 
    {
       return true;
    }
    return false;
  }
  
  public static function fetchAllActors()
  {
    $dbConnection = Database::getInstance()->getConnection();
    $sql = "SELECT * FROM artists";
    mysqli_query($dbConnection, "set names 'utf8'");
    $result = mysqli_query($dbConnection,$sql);
    
    if ($result->num_rows > 0)
    {
      return $result;
    }
     return NULL;
  }
  
  public static function getActorByID($actor_id)
  {
    $dbConnection = Database::getInstance()->getConnection();
    $sql = "SELECT * FROM artists 
            WHERE ID ='$actor_id'";
            
    $result = mysqli_query($dbConnection,$sql);
    
    if(mysqli_num_rows($result) == 1)
    {
      $row = mysqli_fetch_assoc($result);
      $artist = new Artist($row);
      return $artist;
    }
    return NULL;
  }
  
  public static function getActorByName($actor_name)
  {
    $dbConnection = Database::getInstance()->getConnection();
    $sql = "SELECT * FROM artists 
            WHERE Name ='$actor_name'";
            
    $result = mysqli_query($dbConnection,$sql);
    
    if(mysqli_num_rows($result) == 1)
    {
      $row = mysqli_fetch_assoc($result);
      $artist = new Artist($row);
      return $artist;
    }
    return NULL;
  }
  
  public static function deleteActorByID($actor_id)
  {
    $database = Database::getInstance()->getConnection();
    $sql = "DELETE FROM artists 
            WHERE ID='$actor_id'";
    	
    $query_result = $database->query($sql);
    
    if ($query_result === TRUE) 
    {
      return true;
    }
    return false;
  }
  
}
