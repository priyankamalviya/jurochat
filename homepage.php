<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	extract($_POST);
$cal=$_POST['json'];
if(strlen($cal)!=0)
	{
	//$_SESSION['fb']==1;
	$temp=str_replace("\"","",$cal);
	$temp=str_replace("[","",$temp);
	$temp=str_replace("]","",$temp);
	$cal1=explode(',',$temp);
	
	//OPEN connection to DB
	
	$j=count($cal1);
	$name1=$cal1[$j-2];
	$email1=$cal1[$j-1];
	$_SESSION['email']=$email1;
	$_SESSION['name']=$name1;
	$_SESSION['list']=$cal1;
	
	//for($i=0;$i<$j-1;$i++)
	//{
		
		//$stringFriend1=$cal1[$i];
		//echo "<a href='jurochat.php?name=$name1&friend=$stringFriend1' id='testBtn' data-role='button' data-inline='true' data-icon='star' data-iconpos='right' data-transition='flip' onmouseover='mDown(this)' onmouseleave='mUp(this)'>$stringFriend1</a>";
		//echo "<br>";
		//insert into db ,values -name1 ,friends lists
		
	//}
	//echo "<div data-role='footer'>";

	//echo "<h2>&copy; CMPE220 JuRoCHAT Fall'15</h2>";

    //echo "</div>";
	//die();
	}
	if(!count($_SESSION))
{
session_destroy();
echo "<script> window.location='frontpage.html'</script>";
die();
}
?>
<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<link rel="stylesheet" href="themes/myTheme.css" />
<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
 <script src="jAlert-master/jAlert-master/src/jAlert-functions.js"></script>
<link rel="stylesheet" href="jAlert-master/jAlert-master/src/jAlert-v3.css" />
<script src="jAlert-master/jAlert-master/src/jAlert-v3.js"></script>

<!--<link rel="stylesheet" href="/resources/demos/style.css">
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>-->
<!--<link rel="stylesheet" href="alertify/css/alertify.css">
<link rel="stylesheet" href="alertify/css/themes/semantic.css">
<script src="alertifyjs/alertify.js"></script>
<script src="alertifyjs/alertify.min.js"></script>-->
<script type="text/javascript">
$(function() {
	var d=new Date();
			var dateAsObject;
			var dateAsObject1;
		$("#dateborrowedlent").mousedown(function(){
    	$("#dateborrowedlent" ).datepicker({onSelect: function(dateText1, inst) { 
      var dateAsString1 = dateText1; //the first parameter of this function
      dateAsObject1 = $(this).datepicker( 'getDate' ); //the getDate method
	  var diff=(Math.round(dateAsObject1-d)/(1000*24*60*60));

	  if(diff>0)
	  {
		  dateAlert("Please do not enter future date");
		  $("#dateborrowedlent").val('');
		  $("#expectedreturndate").val('');
		  dateAsObject=null;
		  dateAsObject1=null;
		   $("#dateborrowedlent").html('');
		  $("#expectedreturndate").html('');
		  //return;
	  }
	  
	  /*if(dateAsObject)
	  {
		  var days=Math.round((dateAsObject-dateAsObject1)/(1000*60*60*24));
		if(days<0)
		{
		  alert("Expected return date cannot be less than borrowed/lent date;");
		  $("#dateborrowedlent").val('');
		  $("#expectedreturndate").val('');
		  dateAsObject=null;
		  dateAsObject1=null;
		   $("#dateborrowedlent").html('');
		  $("#expectedreturndate").html('');
		  console.log($("#dateborrowedlent").val());
		}

	  }*/
   }
});});
		
		$("#expectedreturndate").mousedown(function(){
    	$( "#expectedreturndate" ).datepicker({onSelect: function(dateText, inst) { 
      var dateAsString = dateText; //the first parameter of this function
      dateAsObject = $(this).datepicker( 'getDate' ); //the getDate method
	  //console.log(dateAsObject.getDate());

	  var diff1= Math.ceil((dateAsObject-d)/(1000*24*60*60));
	  if(diff1 <0) //check if the expected date is a future date and not past date
	  {

		  dateAlert("Please do not enter a prior date");
		  $("#dateborrowedlent").val('');
		  $("#expectedreturndate").val('');
		  dateAsObject=null;
		  dateAsObject1=null;
		   $("#dateborrowedlent").html('');
		  $("#expectedreturndate").html('');
	  }
	  else if(!(dateAsObject1)) //check if the lent date is filled before enterign the expected date
	  {
		  dateAlert("Please enter the lent date");
		  $("#dateborrowedlent").val('');
		  $("#expectedreturndate").val('');
		   dateAsObject=null;
		  dateAsObject1=null;
		  
	  }
	  else
	  {
		var days=Math.round((dateAsObject-dateAsObject1)/(1000*60*60*24));
		if(days<0)
		{
		  alert("Expected return date cannot be less than borrowed/lent date;");
		  $("#dateborrowedlent").val('');
		  $("#expectedreturndate").val('');
		   $("#dateborrowedlent").html('');
		  $("#expectedreturndate").html('');
		  dateAsObject=null;
		  dateAsObject1=null;
		}
	}
	
   }
}); });
		
  	});

	
$(document).ready(function(){
	$("#shareAndRemind").submit(function(){
	//alert("Shill");
	var dataShare = $('#shareAndRemind').serialize();
	//alert(dataShare);
	$.ajax({
		url: "shareandremind.php?home=true",
		type: "POST",
		data: dataShare,
		dataType: 'html',
		contentType:'text/html'
		success: function(data) 
		{  
			if (data.status == 401)
			{
				console.log(data);
				//alert("Inside failure");
				$('#displayshareAndRemind').html(data.msg).show(1000);  
			}

			else if(data.status == 200)
			{		
				console.log(data);
				//alert("Inside success");
				//window.location.replace(data.url);
				//$('#displayshareAndRemind').html(data.msg).show(); 
				window.location.replace(data.url);
			}
		},
		error : function(data)
		{
			console.log(data);
			//alert("hi");
			$('#displayshareAndRemind').html(data.msg).show(1000);
		}
	}); 
	return false; 
	});
});
	$(document).ready(function(){
	$("#logout").click(function(){
		confirm(function(e,btn){ //event + button clicked
    e.preventDefault();
	window.location='logout.php';
    //infoAlert('you have to return $itemborrowedlent to $ownerFirstname in $days days');
}, function(e,btn){
    //e.preventDefault();
    //errorAlert('Denied!');
});
		/*var exit=window.confirm("Are you sure you want to Quit");
		if(exit == true)
		{
			window.location='logout.php';

		} */
	});
});

function mDown(obj) {
    obj.style.backgroundColor = "#ccccff";
}
function mUp(obj) {
    obj.style.backgroundColor = "#f5f5f0";
}

$(document).ready(function(){
		  $('#nav a').on('click', function(){
		  var txt =  $(this).text() == "To-do"?"Close to-do":"To-do";
		  $(this).text(txt);
		  $(this).next('ul').toggle();
		   })

		  });
</script>

<style type="text/css">
body {
    background: url(image5.jpg);
    background-repeat:repeat-y;
    background-position:center center;
    background-attachment:scroll;
    background-size:100% 100%;
}
.ui-page {
    background: transparent;
}
.ui-content{
    background: transparent;
}

#testBtn{
width: 20%;
opacity: 0.8;
filter: alpha(opacity=80);
}

a:link {
    text-decoration: none;
}

#nav ul{
  display: none;
}
</style>
</head>
<body>
<div data-role="page" id="pageone">
<div data-role="header">
	<h1>JuRo CHAT</h1>
</div>
<div data-role="main" class="ui-content">
<a href='#popupBasic2' data-role='button' data-rel='popup' data-inline='true' data-icon='info' data-theme='d'>Share and Remind</a>
<div id="displayshareAndRemind" style="color:red" align="right"></div>  
<div data-role="popup" id="popupBasic2" data-transition="pop" data-theme="a" class="ui-corner-all">		    
	<form action="shareandremind.php?home=true" method="post" name="shareAndRemind" id="shareAndRemind">
	<div style="padding:10px 20px;">

			    		<h3>Please fill your details..</h3>

				    	 <input type="text" name="owner" id="yourname" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" placeholder="Username" readonly data-theme="a" />
						<input type="text" name="remindto" id="remindto" value="" placeholder="Remind To" required data-theme="a" />

						 <input type="text" name="itemborrowedlent" id="itemborrowedlent" value="" placeholder="Item Borrowed/Lent" required data-theme="a"/>

						
						  <input type="text" name="dateborrowedlent" id="dateborrowedlent"  placeholder="Date Borrowed/Lent" required data-theme="a" />

						  <input input type="text" name="expectedreturndate" id="expectedreturndate"  placeholder="Expected Return Date" data-theme="a" />				 

						  <h4>Remind</h4>
						  <fieldset data-role="controlgroup" data-type="horizontal">
									
							     	<input type="radio" name="radio-choice" id="radio-choice-1" value="choice-1" checked="checked" />
							     	<label for="radio-choice-1">Once</label>

							     	<input type="radio" name="radio-choice" id="radio-choice-2" value="choice-2"  />
							     	<label for="radio-choice-2">Multiple times</label>
						  </fieldset>
						 <input type="submit" name="submit" value="Share and Remind" data-theme="b"> 

					</div>

	</form> 
</div>
<div align="right" id="nav">
<button id="logout" data-theme="a" type="button"  data-icon="home" data-mini="false" data-inline="true">Logout</button>
<a href="#todo" id= "#todo" data-role="button" data-icon="alert" data-iconshadow="false" data-inline="true" data-transition="slide" data-theme="b">To-do</a>
 <!-- list view  -->
           <ul id ="todolist" data-role="listview" data-theme="a" align="center" class="ui-corner-all">
           <!--<li><a  href="#">h@gmail.com owes me 11 shirts!</a></li>-->
           </ul> 
</div>
<br />
<!--<a href="logout.php" class="ui-btn">Logout</a>-->
<!--<input type="button" id="logout" value="logout">-->
<!--<button name="logout" id="logout" value="logout" text-align="right" data-inline="true">Logout</button>-->
<?php
//session_start();
//error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('America/Los_Angeles');
/*extract($_POST);
$cal=$_POST['json'];
if(strlen($cal)!=0)
	{
	$_SESSION['fb']==1;
	$temp=str_replace("\"","",$cal);
	$temp=str_replace("[","",$temp);
	$temp=str_replace("]","",$temp);
	$cal1=explode(',',$temp);
	
	//OPEN connection to DB
	
	$j=count($cal1);
	$name1=$cal1[$j-2];
	$email1=$cal1[$j-1];
	$_SESSION['email']=$email1;
	$_SESSION['name']=$name1;
	$_SESSION['list']=$cal1;
	
	//for($i=0;$i<$j-1;$i++)
	//{
		
		//$stringFriend1=$cal1[$i];
		//echo "<a href='jurochat.php?name=$name1&friend=$stringFriend1' id='testBtn' data-role='button' data-inline='true' data-icon='star' data-iconpos='right' data-transition='flip' onmouseover='mDown(this)' onmouseleave='mUp(this)'>$stringFriend1</a>";
		//echo "<br>";
		//insert into db ,values -name1 ,friends lists
		
	//}
	//echo "<div data-role='footer'>";

	//echo "<h2>&copy; CMPE220 JuRoCHAT Fall'15</h2>";

    //echo "</div>";
	//die();
	}*/
	//if condition if emauil get reeust is present ,then go to regular part ,else go to the facebook freidsn database and based upon the session name retrieve the list
	if((count($_SESSION['list'])))
	{
		$k=count($_SESSION['list']);
		$name1=$_SESSION['name'];
		$email1=$_SESSION['email'];//retrieve the email back from the session variables
		//foreach($_SESSION['list'] as $key=>$value)
		for($i=0;$i<$k-2;$i++)
		{
			$stringFriend1=$_SESSION['list'][$i];
			echo "<a href='jurochat.php?name=$name1&friend=$stringFriend1'  id='testBtn' data-role='button' data-inline='true' data-icon='star' data-iconpos='right' data-transition='flip' onmouseover='mDown(this)' onmouseleave='mUp(this)'>$stringFriend1</a>";
			echo "<br>";
		//insert into db ,values -name1 ,friends lists
		}
		$servername = "localhost";

	$username = "root";
	$dbname = "jurochat";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
	}
$lastname1="";
$password1="";
$sql2="SELECT * FROM `signup` where `email`='$email1'";
$result1=$conn->query($sql2);
$row=$result1->fetch_assoc();
if(!($row) && (strlen($email1)!=0) && (strlen($name1)!=0)) //check if the mail id does nto exits and the name and email id fields are not null
{
		//echo "insertion happened";
	$sql1 = "INSERT INTO signup VALUES ('$name1', '$lastname1','$email1','$password1')";
	$result2=$conn->query($sql1);
	
}
	//$array = array();
	$sql="SELECT * FROM signup"; 
    $result = $conn->query($sql);
	if ($result->num_rows > 0) 
	{
     // output data of each row
	     while($row = $result->fetch_assoc())
	    {
if((strcmp($row["email"], $email1))!=0)
	     	{
				$stringFriend= $row["firstname"]. " " . $row["lastname"];	
	         		//$_SESSION['friend']=$stringFriend;//wats the need of this line?
					//echo "<a href='jurochat.php?name=$name1&friend=$stringFriend'  id='testBtn' data-role='button' data-inline='true' data-icon='arrow-r' data-iconpos='right' data-transition='flip' onmouseover='mDown(this)' onmouseleave='mUp(this)'>$stringFriend</a>";
					//echo "<br>";
					//$k=count($_SESSION['list']);
					$value=$row["lastname"];
					if(strlen($value))
					{
	         		//$_SESSION['friend']=$stringFriend;//wats the need of this line?
					echo "<a href='jurochat.php?name=$name1&friend=$stringFriend'  id='testBtn' data-role='button' data-inline='true' data-icon='arrow-r' data-iconpos='right' data-transition='flip' onmouseover='mDown(this)' onmouseleave='mUp(this)'>$stringFriend</a>";
					echo "<br>";
					}
					//$p=0;
		}
		}
	}
	$firstname=$_SESSION['name'];
	$firstname=trim($firstname);
	
	//to-do part queries
	$sql1="SELECT signup.firstname,shareandremind.itemborrowedlent,shareandremind.owner,shareandremind.expectedreturndate,shareandremind.reminder,shareandremind.remindto
	     FROM signup 
	     INNER JOIN shareandremind 
	     ON shareandremind.remindto = signup.email WHERE
	 		signup.firstname = '$firstname'";
			//echo $sql1;
			
	    $result1= $conn->query($sql1);
		//var_dump($result1);
		//echo "ETELL";
		//echo $result;
		//echo "firstname".$firstname;
		//echo "hi";
		//echo $result;
		if ($result1->num_rows > 0) 
		{
				//echo "hi";
				//$row=$result1->fetch_assoc();
				//print_r($row);
			while($row=$result1->fetch_assoc())
		    {
				//echo "hi";
					
		    	//put firstname, itemborrowedlent and owner into variables
					$todaydate=date("Y/m/d");
					$date=$row["expectedreturndate"];
					$owner=$row["owner"];
		    		$itemborrowedlent=$row["itemborrowedlent"];
					$reminder=$row["reminder"];
		    		$remindto=$row["remindto"];
		    		$sql2 = "SELECT firstname FROM signup where `email` = '$owner'";
					$result2 = $conn->query($sql2);
					$row2 = $result2->fetch_assoc();
					$ownerFirstname=$row2["firstname"]; //retreive the name from the signup table 
								     	//populate the reminder message into the list dynamically
					//$ownerLastname=$row2["lastname"];
					//$ownerFirstname=$ownerFirstname." ".$ownerLastname;
					
					$date1=strtotime($date);
					 $date2=strtotime($todaydate);
					 $diff = $date1-$date2;
					$days = floor($diff/(24*60*60));
					//$years = floor($diff / (365*60*60*24));
					//$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					//$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
					
				     echo "<script type='text/javascript'>
			         
					 var todolist = $('#todolist');
					 var todo=$('#todo');
					 var pitem = $('<li / >').html('You have borrowed $itemborrowedlent from $ownerFirstname and need to return by $date' );
					 todolist.append(pitem);
					 todo.append(pitem);
					todolist.listview('refresh');
			
					 </script>";
					 
					 
					if(!($_GET['chat'])) {
					if(strcmp($reminder, "choice-2")==0)
						 {
							if($days<=2 && $days>=0)
							{
								if($days==0)
								{
									echo "<script> warningAlert('You have to return $itemborrowedlent to $ownerFirstname today!!!')</script>";
								}
								elseif($days==1)
								{
									echo "<script> warningAlert('You have to return $itemborrowedlent to $ownerFirstname tomorrow!!!')</script>";
								}
								else
								{
									echo "<script> infoAlert('You have to return $itemborrowedlent to $ownerFirstname in $days days')</script>";
								}
							}
						}
						if(strcmp($reminder, "choice-1")==0)
						 {
						 		if($days==1)
								{
									echo "<script> warningAlert('You have to return $itemborrowedlent to $ownerFirstname tomorrow!!!')</script>";
								}
								else if($days==0)
								{
									echo "<script> warningAlert('You have to return $itemborrowedlent to $ownerFirstname today')</script>";
								}
								else if($days==2)
								{
						 			echo "<script> infoAlert('You have to return $itemborrowedlent to $ownerFirstname in $days days')</script>";
						 		}
								//alert("coming near update");
								 	$sql6 = "UPDATE shareandremind SET reminder='nochoice' WHERE remindto='$remindto'and itemborrowedlent='$itemborrowedlent'";
								 	if ($conn->query($sql6) === TRUE) {
										    //echo "Record updated successfully";
										} else {
										    //echo "Error updating record: " . $conn->error;
										}
										$conn->close();
						 		}
					}
	    	}
	    }
		else
		{
			 echo "<script type='text/javascript'>
			     var todolist = $('#todolist');
				 
				 var pitem = $('<li / >').html('You have no to do items');
				 todolist.append(pitem);	
			 </script>";
		}
		
	echo "<div data-role='footer'>";

	echo "<h2>&copy; CMPE220 JuRoCHAT Fall'15</h2>";

    echo "</div>";
	$conn->close();
		die();
	}
	if(count($_SESSION))
	{
	$_SESSION['fb']==0;
	$firstname=$_SESSION['firstname'];
    $lastname=$_SESSION['lastname'];
	$name= $firstname. " " . $lastname;
	$_SESSION['name']=$name;	
	
	$servername = "localhost";

	$username = "root";

	$password = "root";

	$dbname = "jurochat";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
	}
	//$array = array();
	$sql3="SELECT * FROM signup"; 
    $result = $conn->query($sql3);
	if ($result->num_rows > 0) 
	{
     // output data of each row
	     while($row = $result->fetch_assoc())
	    {
	     	if((strcmp($row["firstname"], $firstname))!=0 || (strcmp($row["lastname"], $lastname))!=0) 
	     	{
	         		$stringFriend= $row["firstname"]. " " . $row["lastname"];	
	         		//$_SESSION['friend']=$stringFriend; //wat is the need of this line?
	         //echo "<meta http-equiv=Refresh content=0;url=jurochat_work.php>";
			//echo  "<li style='list-style-type:none'>"."<button".$stringFriend."<a href='jurochat_work.php'>"."</a>"."</button>"."</li>";	
			//echo  "<li style='list-style-type:none'>"."<button>"."<a href='jurochat_work.php' data-mini='true' data-inset='true'>".$stringFriend."</a>"."</button>"."</li>";			
	    	//echo "<li style='list-style-type:none'>"."<button>".$stringFriend."<a href='jurochat_work.php'>"."</a>"."</button>"."</li>";
					echo "<a href='jurochat.php?name=$name&friend=$stringFriend'  id='testBtn' data-role='button' data-inline='true' data-icon='arrow-r' data-iconpos='right' data-transition='flip' onmouseover='mDown(this)' onmouseleave='mUp(this)'>$stringFriend</a>";
					echo "<br>";
					//echo "<button>"."<a href='jurochat_work.php' style='text-decoration:none;'>$stringFriend</a>"."</button>";
			}	
		}
    }
	else
	{
     echo "0 results";
	}
	
	//to-do part queries
	$sql4="SELECT signup.firstname,shareandremind.itemborrowedlent,shareandremind.owner,shareandremind.expectedreturndate,shareandremind.reminder,shareandremind.remindto
	     FROM signup 
	     INNER JOIN shareandremind 
	     ON shareandremind.remindto = signup.email WHERE
	 		signup.firstname = '$firstname'";
	    $result = $conn->query($sql4);
		
		if ($result->num_rows > 0) 
		{
			
	     // output data of each row
		     while($row = $result->fetch_assoc())
		    {
					
		    	//put firstname, itemborrowedlent and owner into variables
					$todaydate=date("Y/m/d");
					$date=$row["expectedreturndate"];
					$owner=$row["owner"];
		    		$itemborrowedlent=$row["itemborrowedlent"];
					$reminder=$row["reminder"];
		    		$remindto=$row["remindto"];
		    		$sql5 = "SELECT firstname,lastname FROM signup where `email` = '$owner'";
					$result1 = $conn->query($sql5);
					$row2 = $result1->fetch_assoc();
					$ownerFirstname=$row2["firstname"]; //retreive the name from the signup table 
								     	//populate the reminder message into the list dynamically
					$ownerLastname=$row2["lastname"];
					$ownerFirstname=$ownerFirstname." ".$ownerLastname;
				
					$date1=strtotime($date);
					 $date2=strtotime($todaydate);
					 $diff =$date1-$date2;
					//$years = floor($diff / (365*60*60*24));
					//$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					//$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
					$days=floor($diff/(24*60*60));
					
				     echo "<script type='text/javascript'>
			         
					 var todolist = $('#todolist');
					 var todo=$('#todo');
					 var pitem = $('<li / >').html('You have borrowed $itemborrowedlent from $ownerFirstname and need to return by $date' );
					 todolist.append(pitem);
					 todo.append(pitem);
					todolist.listview('refresh');
			
					 </script>";
					 
					 if(!($_GET['chat'])) {
					if(strcmp($reminder, "choice-2")==0)
						 {
							if($days<=2 && $days>=0)
							{
								if($days==0)
								{
									echo "<script> warningAlert('You have to return $itemborrowedlent to $ownerFirstname today!!!')</script>";
								}
								elseif($days==1)
								{
									echo "<script> warningAlert('You have to return $itemborrowedlent to $ownerFirstname tomorrow!!!')</script>";
								}
								else
								{
									echo "<script> infoAlert('You have to return $itemborrowedlent to $ownerFirstname in $days days')</script>";
								}
							}
						}
						if(strcmp($reminder, "choice-1")==0)
						 {
						 		if($days==1)
								{
									echo "<script> warningAlert('You have to return $itemborrowedlent to $ownerFirstname tomorrow!!!')</script>";
								}
								else if($days==0)
								{
									echo "<script> warningAlert('You have to return $itemborrowedlent to $ownerFirstname today')</script>";
								}
								else if($days==2)
								{
						 			echo "<script> infoAlert('You have to return $itemborrowedlent to $ownerFirstname in $days days')</script>";
						 		}
								 	$sql6 = "UPDATE shareandremind SET reminder='nochoice' WHERE remindto='$remindto'and itemborrowedlent='$itemborrowedlent'";
								 	if ($conn->query($sql6) === TRUE) {
										    //echo "Record updated successfully";
										} else {
										    //echo "Error updating record: " . $conn->error;
										}
										$conn->close();

						 		}
					 }
	    	}
	    }
		else
		{
			 echo "<script type='text/javascript'>
			     var todolist = $('#todolist');
				 
				 var pitem = $('<li / >').html('You have no to do items');
				 todolist.append(pitem);
			 </script>";
		}

    $conn->close();
	
	echo "<div data-role='footer'>";

	echo "<h2>&copy; CMPE220 JuRoCHAT Fall'15</h2>";

    echo "</div>";
	die();
	}
	else{
		header('Location:frontpage.html');
		exit();
	}
?>
</div>
</div>
</body>
</html>
