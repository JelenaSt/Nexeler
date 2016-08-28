
<h1>Kontakt informacije:</h1>

<?php
header("Content-Type: text/html;charset=utf-8");

require_once(dirname(__FILE__)."\..\..\core\Database.php");
require_once(dirname(__FILE__)."\..\..\config\database.config.php");

$database = Database::getInstance();
$dbConnection = $database->getConnection();

mysqli_select_db($dbConnection, DB_NAME) ;

$query = "SELECT * FROM Contact ";

mysqli_query($dbConnection, "set names 'utf8'");

$result = mysqli_query($dbConnection, $query) or die("Greska u upitu: " . mysql_error());

if (mysqli_num_rows($result) > 0) 
{
    $row = mysqli_fetch_array($result);
    echo "<br>";

    $president = $row['President'];
    $vicePresident = $row['VicePresident'];
    $prmanager = $row['PRManager'];

    $phone1 = $row['Phone1'];
    $phone2 = $row['Phone2'];
    $phone3 = $row['Phone3'];

    $fax = $row['Fax'];
    $email = $row['E-mail'];
    $address = $row['Address'];

    $outText = '<table><td width= 50%/><td width= 50%/>';

    if (!empty($president))
    { 
        $outText.= '<tr>';
        $outText.= '<td>Direktor : </td>';
        $outText.= "<td>$president</td>";
        $outText.= '</tr>';
        
    }
    if (!empty($vicePresident))
	{ 
        $outText.= '<tr>';
        $outText.= "<td>Zamenik direktora :    </td>";
        $outText.= "<td>$vicePresident</td>";
        $outText.= '</tr>';
    }
    if (!empty($prmanager)) 
	{ 
        $outText.= '<tr>';
        $outText.= '<td>PR menadzer : </td>';
        $outText.= "<td>$prmanager</td>";
        $outText.= '</tr>';
    }
	if (!empty($phone1)||!empty($phone2)||!empty($phone3)) 
	{
        $outText.= '<tr>';
        $outText.= '<td>Telefon : </td><td>';
		
		$telIndex = 0;
		if (!empty($phone1))
		{
			$outText.= "$phone1";
			$telIndex+=1;
		}
		if (!empty($phone2))
		{
			if ($telIndex != 0) $outText.= '<br>';
			$outText.= "$phone2";
			$telIndex+=1;
		}
		if (!empty($phone3))
		{
			if ($telIndex != 0) $outText.= '<br>';
			$outText.= "$phone3";
		}
		
        $outText.= '</td><tr>';
    }

    if (!empty($fax)) 
	{ 
        $outText.= '<tr>';
        $outText.= '<td>Fax : </td>';
        $outText.= "<td>$fax</td>";
        $outText.= '</tr>';
    } 
    if (!empty($email)) 
	{ 
        $outText.= '<tr>';
        $outText.= '<td>E-mail : </td>';
        $outText.= "<td>$email</td>";
        $outText.= '</tr>';
    }
    if (!empty($address)) 
	{ 
        $outText.= '<tr>';
        $outText.= '<td>Adresa : </td>';
        $outText.= "<td>$address</td>";
        $outText.= '</tr>';
    }

    $outText.='</table>';

    echo $outText;
}
?>

