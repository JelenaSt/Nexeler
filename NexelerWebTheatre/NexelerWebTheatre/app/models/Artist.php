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
    
    public static function writeNewArtistInDatabase($artistName,$artistBio)
    {
        $database = Database::getInstance()->getConnection();
        $sql = "SELECT MAX ID 
                FROM artists";
        $query_result = mysqli_query($database, $sql);
        $row = mysqli_fetch_array($query_result);
        
        $artistId = $row + 1;
        $sql = "INSERT INTO artists (ID,Name,Biography)
                VALUES ('$artistId','$artistName','$artistBio')";
        $query_result = mysqli_query($database, $sql);
        print_r($query_result);
        if ($query_result === TRUE) 
        {
            return true;
        }
        return false;
    }
    
    public static function updateArtist($artistId,$artistName,$artistBio)
    {
        $database = Database::getInstance()->getConnection();
        
        $sql = "UPDATE artists SET Name='$artistName', Biography='$artistBio'
                WHERE ID='$artistId'";
        
        $query_result = $database->query($sql);
        
        if ($query_result === TRUE) 
        {
            return true;
        }
        
        return false;
    }
    
    public static function fetchAllArtist()
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
    
    public static function getArtistByID($artistId)
    {
        $dbConnection = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM artists 
                WHERE ID ='$artistId'";
        
		mysqli_query($dbConnection, "set names 'utf8'");		 
        $result = mysqli_query($dbConnection,$sql);
        
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            $artist = new Artist($row);
            return $artist;
        }
        return NULL;
    }
    
    public static function getArtistByName($artistName)
    {
        $dbConnection = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM artists 
                WHERE Name ='$artistName'";
        
		mysqli_query($dbConnection, "set names 'utf8'");
        $result = mysqli_query($dbConnection,$sql);
        
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            $artist = new Artist($row);
            return $artist;
        }
        return NULL;
    }
    
    public static function deleteArtistByID($artistId)
    {
        $database = Database::getInstance()->getConnection();
        $sql = "DELETE FROM artists 
                WHERE ID='$artistId'";
        
        $query_result = $database->query($sql);
        
        if ($query_result === TRUE) 
        {
            return true;
        }
        return false;
    }
    
    //picture related methods
    public static function writeNewArtistPictureInDatabase($artistId,$artistPicture)
    {
        $database = Database::getInstance()->getConnection();
        $sql = "INSERT INTO artistpictures (ArtistID,ArtistPicture)
                VALUES ('$artistId','$artistPicture')";
        $query_result = mysqli_query($database, $sql);
        print_r($query_result);
        if ($query_result === TRUE) 
        {
            return true;
        }
        return false;
    }
    
    public static function getArtistPictureById($artistId)
    {
        $dbConnection = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM artistpictures 
                 WHERE ArtistID ='$artistId'";
        $result = mysqli_query($dbConnection,$sql);
        
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            return $row['ArtistPicture'];
        }
        return NULL;
    }

    public static function deleteActorPictureByID($artistId)
    {
        $database = Database::getInstance()->getConnection();
        $sql = "DELETE FROM artistpictures 
                WHERE ArtistID='$artistId'";
        
        $query_result = $database->query($sql);
        
        if ($query_result === TRUE) 
        {
            return true;
        }
        return false;
    }
    
    public static function updateArtistPicture($artistId,$picture)
    {
        $database = Database::getInstance()->getConnection();
        
        $sql = "UPDATE artists SET ArtistPicture='$picture'
                WHERE ArtistID='$artistId'";
        
        $query_result = $database->query($sql);
        
        if ($query_result === TRUE) 
        {
            return true;
        }
        
        return false;
    }
    
}
