<?php

class Actor
{
  var $actorID;
  var $name;
  var $last_name;
  var $date_birth;
  var &biography;
  
  public funstion __construct()
  {
  }
  
  public static function writeNewActorInDatabase($actor_name,$actor_last_name,$actor_date_birth,$actor_desc)
  {
  
  }
  
  public static function updateActor($actor_id,$actor_name,$actor_last_name,$actor_date_birth,$actor_desc)
  {
  
  }
  
  public static function fetchAllActors()
  {
  
  }
  
  public static function getActorByID($actor_id)
  {
  
  }
  
  public static function getActorByNameAndLastname($actor_name,$actor_lastname)
  {
  
  }
  
  public static function deleteActorByID($actor_id)
  {
  
  }
  
}
