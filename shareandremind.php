<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
$temp=$_SESSION['temp'];

$friend=$_SESSION['friend'];

$servername = "localhost";

$username = "root";

$password = "root";

$dbname = "jurochat";

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error)
{
     die("Connection failed: " . $conn->connect_error);
}
$owner = $_POST['owner'];
$remindto = $_POST['remindto'];
$itemborrowedlent = $_POST['itemborrowedlent'];
//$quantity = $_POST['quantity'];
$dateborrowedlent= $_POST['dateborrowedlent'];
$expectedreturndate= $_POST['expectedreturndate'];
$reminder=$_POST['radio-choice'];
$domain=strstr($owner,'@');
$domain1=substr($domain,1);
$sql = "SELECT * FROM signup WHERE `email` = '$owner'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	if(!($row))
	{
	    echo '{"status":401,"msg":"ERROR!The Owner EMAIL ID  does not exist in our records. Please check the EMAIL ID !!!"}';
	} 
	else
	{ 
		$sql1 = "SELECT * FROM signup WHERE `email` = '$remindto'";
		$result = $conn->query($sql1);
		$row1 = $result->fetch_assoc();
		if(!($row1))
		{
		    echo '{"status":401,"msg":"ERROR!The EMAIL ID of the person to be reminded does not exist in our records. Please check the EMAIL ID !!!"}';
		} 
		else if($owner == $remindto)
		{
			echo '{"status":401,"msg":"ERROR!The borrower and lender id cannot be same !!!"}';
		}
		else
		{	
			$sql1 = "INSERT INTO shareandremind VALUES ('$owner', '$remindto','$itemborrowedlent','$dateborrowedlent','$expectedreturndate','$reminder')";

			if ($conn->query($sql1) === TRUE)
			{
				//for share and remind in homepage $temp and $friend are NULL
				if(isset($_GET['home'])){
						echo '{"status":200,"url":"homepage.php?chat=true"}';
						exit();
				}
				//var $url="jurochat.php?name='.$temp.'&friend='.$friend.'";
				//header("Location:jurochat.php"); 
				//echo '{"status":200,"url":'jurochat.php?name='$temp'&friend='$friend''}';
				//echo "url":"jurochat.php?temp=$temp&friend=$friend";
				//exit();
				else{
						echo '{"status":200,"url":"jurochat.php?name='.$temp.'&friend='.$friend.'"}';
						//header("Location:http://localhost/220/jurochat.php?name='.$temp.'&friend='.$friend.'");
						exit();
						
				}
			} 
		}
	}
$conn->close();

?>