
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

    $outText = '<div id ="item" >';

    if (!empty($president)) $outText.= 'Direktor : '."$president"."<br>";
    if (!empty($vicePresident)) $outText.=  'Zamenik direktora : '."$vicePresident"."<br>";
    if (!empty($prmanager)) $outText.=  'PR menadzer : '."$prmanager"."<br>";
    if (!empty($phone1)) $outText.=  'Telefon : '."$phone1"."<br>";
    if (!empty($phone2)) $outText.=  "$phone2"."<br>";
    if (!empty($phone3)) $outText.=  "$phone3"."<br>";

    if (!empty($fax)) $outText.=  'Fax : '."$fax"."<br>";
    if (!empty($email)) $outText.=  'E-mail : '."$email"."<br>";
    if (!empty($address)) $outText.=  'Adresa : '."$address"."<br>";

    $outText.='</div>';

    echo $outText;
}
?>

