<?php
error_reporting(E_ERROR | E_PARSE);
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

$firstname = $_POST['firstname'];

$lastname = $_POST['lastname'];

$email = $_POST['email'];

$password = $_POST['password'];

$confirm=$_POST['confirm_password'];

//$re_password= $_POST['repwd'];

$domain=strstr($email,'@');

$domain1=substr($domain,1);

$has_dns_mx_record = checkdnsrr($domain1,"MX");

if(strlen($email)>256)

{

	$i=1;

	//echo "ERROR!Email id  cannot exceed 256 characters";
	echo '{"status":401,"msg":"ERROR!Email id  cannot exceed 256 characters"}';
	//die();

	

}

if(!filter_var($email, FILTER_VALIDATE_EMAIL))

{

	$i=1;

	//echo"ERROR!The EMAIL ID IS not a a valid one !\n";

	//echo '<span style="color:red; text-align:center;">ERROR! The EMAIL ID is not a valid one!</span>';
	//echo '{"status":401,"msg":"ERROR!The EMAIL ID is not a valid one!"}';
	header('Content-type: application/json');
	//echo'{"status" => 401,"msg" =>"ERROR!The EMAIL ID is not a valid one!"}';
	$json=array("status" => 401, "msg" => "Error The email ID is not a valid one");
	echo json_encode($json);
	
	die();

}

if($has_dns_mx_record==false)

{

	$i=1;

	//echo '<span style="color:red; text-align:center;">ERROR! This domain does not exist!!! Please enter a proper email id.</span>';
	header('Content-type: application/json');	
	//echo '{"status":401,"msg":"ERROR! This domain does not exist!!! Please enter a proper email id."}';
	$json=array("status" => 401, "msg" => "Error domain does not exist");
	echo json_encode($json);
	die();

}

if(!(preg_match("/[A-Z]+/",$password)))

{

	$i=1;
	header('Content-type: application/json');	
	$json=array("status" => 401, "msg" => "ERROR! The password must contain atleast one capital alphabet");
	echo json_encode($json);
	
	die();
	//echo '<span style="color:red; text-align:center;">ERROR! The password must contain atleast one capital alphabet.</span>';
	//echo '{"status":401,"msg":"ERROR! The password must contain atleast one capital alphabet."}';
	//$json=array("status" => 401, "msg" => "Error must contain atleast one capital letter");
	//echo json_encode($json);
	//die();

}

if(!(preg_match("/[0-9]+/",$password)))

{

	$i=1;
	header('Content-type: application/json');
	//echo " ERROR! The Password must contain atleast one number\n";
	$json=array("status" => 401, "msg" => "ERROR! The Password must contain atleast one number");
	echo json_encode($json);
	die();
	//echo '{"status":401,"msg":"ERROR! The Password must contain atleast one number"}';
	//die();

}



if(!(preg_match("/[a-z]+/",$password)))

{

	$i=1;
	header('Content-type: application/json');
	$json=array("status" => 401, "msg" => "ERROR! The Password must contain atleast one small alphabet");
	echo json_encode($json);
	//echo " ERROR! The Password must contain atleast one small alphabet\n";
	//echo '{"status":401,"msg":"ERROR! The Password must contain atleast one small alphabet"}';
	//die();

}

if(!(preg_match('/[#@!$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\"]+/',$password)))

{
	$i=1;
	header('Content-type: application/json');
	$json=array("status" => 401, "msg" => "ERROR! The Password must contain atleast one special character");
	echo json_encode($json);
	//echo "ERROR! The Password must contain atleast one special character\n";
	//echo '{"status":401,"msg":"ERROR! The Password must contain atleast one special character"}';
	

	//die();

}
if($password !== $confirm)
{	
	$i=1;
	header('Content-type: application/json');
	//echo '{"status":401,"msg":"ERROR! The Password and confirm password must match"}';
	$json=array("status" => 401, "msg" => "ERROR! The Password and confirm password must match");
	echo json_encode($json);
	
}
$sql2="SELECT * FROM `signup` where `email`='$email'";

$result1=$conn->query($sql2);

$row=$result1->fetch_assoc();

if($row)

{

	$i=1;
	header('Content-type: application/json');
	//echo " ERROR! The User Already Exists .Please Give a unique email id !!!";
	//echo '{"status":401,"msg":" ERROR! The User Already Exists .Please Give a unique email id !!!"}';
	$json=array("status" => 401, "msg" => "ERROR! The Password and confirm password must match");
	echo json_encode($json);
	die();

}



if($i==0)

{

$sql = "INSERT INTO signup VALUES ('$firstname', '$lastname','$email','$password')";


if ($conn->query($sql) === TRUE) {

//echo "<h1>Hello ".$firstname."</h1>". "<h2>THANK YOU for registering on JuRoCHAT</h2> <br/>";



//echo "<h3>Your account has been created successfully!</h3>";
header('Content-type: application/json');
//echo "<center><strong>Click <a href=frontpage.html>here</a> to Log In</strong></center>";
	echo '{"status":200,"url":"frontpage.html"}';
	//header('Location: http://localhost/220/homepage.php');
	 //header("Location: frontpage.html");	
	 exit();

} 

else {

    //echo "Error: " . $sql . "<br>" . $conn->error;

}

}

$conn->close();

?>

