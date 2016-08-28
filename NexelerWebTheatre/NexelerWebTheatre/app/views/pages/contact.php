<div class="page-body">


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

$result = mysqli_query($dbConnection, $query);

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
        $outText.= '<th>Direktor : </th>';
        $outText.= "<td>$president</td>";
        $outText.= '</tr>';
        
    }
    if (!empty($vicePresident))
	{ 
        $outText.= '<tr>';
        $outText.= "<th>Zamenik direktora :    </th>";
        $outText.= "<td>$vicePresident</td>";
        $outText.= '</tr>';
    }
    if (!empty($prmanager)) 
	{ 
        $outText.= '<tr>';
        $outText.= '<th>PR menadzer : </th>';
        $outText.= "<td>$prmanager</td>";
        $outText.= '</tr>';
    }
	if (!empty($phone1)||!empty($phone2)||!empty($phone3)) 
	{
        $outText.= '<tr>';
        $outText.= '<th>Telefon : </th><td>';
		
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
        $outText.= '<th>Fax : </th>';
        $outText.= "<td>$fax</td>";
        $outText.= '</tr>';
    } 
    if (!empty($email)) 
	{ 
        $outText.= '<tr>';
        $outText.= '<th>E-mail : </th>';
        $outText.= "<td>$email</td>";
        $outText.= '</tr>';
    }
    if (!empty($address)) 
	{ 
        $outText.= '<tr>';
        $outText.= '<th>Adresa : </th>';
        $outText.= "<td>$address</td>";
        $outText.= '</tr>';
    }

    $outText.='</table>';

    echo $outText;
}
?>
</div>
