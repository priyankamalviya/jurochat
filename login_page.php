<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "jurochat";
$i=0;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];

$pass= $_POST['password'];

$domain=strstr($email,'@');

$domain1=substr($domain,1);

$has_dns_mx_record = checkdnsrr($domain1,"MX");

if(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    $i=1;
    //echo '<span style="color:red; text-align:center;">ERROR! The EMAIL ID is not a valid one!</span>';
    echo '{"status":401,"msg":"ERROR! The EMAIL ID is not a valid one!"}';
    die();
}
if($has_dns_mx_record==false)
{
    //echo '<span style="color:red; text-align:center;">ERROR! This domain does not exist!!! Please enter a proper email id.</span>';
     echo '{"status":401,"msg":"ERROR! This domain does not exist!!! Please enter a proper email id"}';
    $i=1;
    die();
}

if($i==0)
{    
$sql = "SELECT * FROM signup where `email` = '$email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if(!($row))
{
    $i=1;
    //echo "<span style='color:red; text-align:center;'>ERROR! This EMAIL ID  does not exist in our records. Please check your EMAIL ID !!!</span>";
    //echo "<a href=frontpage.html> Try again</a>";
    echo '{"status":401,"msg":"ERROR!This EMAIL ID  does not exist in our records. Please check your EMAIL ID !!!"}';
} 
else
{    
if(strcmp($row["password"],$pass)==0)
{
    $_SESSION['firstname']=$row["firstname"];
    $_SESSION['lastname']=$row["lastname"];
	$_SESSION['email']=$row["email"];
    $firstname= $row["firstname"];
    $lastname= $row["lastname"];   
    echo '{"status":200,"url":"homepage.php"}';
    //echo "<h1>WELCOME TO JuroChat</h1>";
    //echo "<a href='homepage.php?firstname=$firstname&lastname=$lastname'>Have fun</a>";
    //header('Location: http://localhost/220/homepage.php?email='.urlencode("$email"),true);
    exit();
}
else
{
    //echo '<span style="color:red; text-align:center;">ERROR! INVALID EMAIL ID or PASSWORD!!!</span>';
    echo '{"status":401,"msg":"ERROR! INVALID EMAIL ID or PASSWORD!!!"}';
}
 
}
}
$conn->close();
?>