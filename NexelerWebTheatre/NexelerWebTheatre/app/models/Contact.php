<?php

/**
 * Contact short summary.
 *
 * Contact description.
 *
 * @version 1.0
 * @author Jelena
 */
class Contact
{
    var $president;
    var $vicePresident;
    var $prmanager;
    var $phone1;
    var $phone2;
    var $phone3;
    var $fax;
    var $email;
    var $address;

    public function __construct($args)
    {
        $this->president = $args['President'];
        $this->vicePresident =$args['VicePresident'];
        $this->prmanager =$args['PRManager'];
        $this->phone1 = $args['Phone1'];
        $this->phone2 = $args['Phone2'];
        $this->phone3 = $args['Phone3'];
        $this->fax = $args['Fax'];
        $this->email = $args['E-mail'];
        $this->address = $args['Address'];
    }

    public static function updateContactInformation ()
    {
        

    }

    public static function readContactInfo()
    {
        $database = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM Contact ";
        
        mysqli_query($database, "set names 'utf8'");		 
        $result = mysqli_query($database,$sql);

        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            $contact = new Contact($row);
            return $contact;	
        }
        return NULL;

    }
}