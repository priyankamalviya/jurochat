<html>
<head>
	<title>Chat Module</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
	<link rel="stylesheet" href="themes/myTheme.css" />
	<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">';
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>';
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>';
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>';
	<!--<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>';
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>';
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>';-->
	<script src="jAlert-master/jAlert-master/src/jAlert-functions.js"></script>
	<link rel="stylesheet" href="jAlert-master/jAlert-master/src/jAlert-v3.css" />
	<script src="jAlert-master/jAlert-master/src/jAlert-v3.js"></script>
	
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
</style>
</head>
<body>
<div data-role="page" id="pageone">
<div data-role="header">
	<h1>JuRo CHAT</h1>
</div>
<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
if(count($_SESSION))
{
if(($_SERVER['REQUEST_METHOD']) === 'POST') 
{ 
	$temp=$_POST['name'];//retrieve the user name forom the post paramters
	$friend=$_POST['friend'];//retrieve the friend name 
}
else
{
	$temp=$_GET['name'];//retrieve the user name forom the GET paramters
	$friend=$_GET['friend'];
}
//coming from shareandremind.php to jurochat
if(strlen($temp)!=0 && strlen($friend)!=0)
{
	$_SESSION['temp']=$temp;

	$_SESSION['friend']=$friend;
}
else
{
	$temp = $_SESSION['temp'];
	$friend = $_SESSION['friend'];
}
if(strlen($temp) > 0 && strlen($friend)>0) //both are not null
{
	$_SESSION['name']=$temp; //set the session to the user name
	//echo "Welcome $temp and $friend";
	global $target_dir,$filename;
	$target_dir='./'."chats";//create a directory with the user name
	$result=mkdir($target_dir,0755);////make directory
	$names=array($temp,$friend);
	sort($names);
	
	
	$first=$names[0];
	$second=$names[1];
	$filename=$target_dir.'/'.$first.'_'.$second.'.html';
}
echo "<div data-role='main' class='ui-content'> "; //body pART of JQM strts here
	echo "<div id='menu'>";
        echo "<strong><center>Welcome $temp and $friend</center></strong>";
		echo "<div align='right'>";
		echo "<a href='#' data-role='button' id='back' data-icon='back' data-inline='true' style='width:10%'>HOME</a>";
		echo "<a href='#popupBasic3' data-role='button' data-rel='popup' data-inline='true' data-icon='info' data-theme='d' style='width:10%'>Share and Remind</a>";
		echo "<a href='#' data-role='button' id='exit' class='logout' data-icon='delete' data-inline='true' data-theme='b' style='width:10%'>Exit Chat</a>";	
		echo "</div>";
        echo "<div style='clear:both'></div>";
		echo "<div class='chat' id='chatbox'>";
		//echo '<textarea cols="40" rows="8" name="textarea" id="textarea">';
			if(file_exists($filename) && filesize($filename) > 0)
			{
			    $handle = fopen($filename, "r");
			    $contents = fread($handle, filesize($filename));
			    fclose($handle);     
			    echo $contents;
			}
			else
			{
					//echo "Inside else";
					$_SESSION['name']=$temp; //set the session to the user name
					//echo "Welcome $temp and $friend";
					global $target_dir,$filename;
					$target_dir='./'."chats";//create a directory with the user name
					$result=mkdir($target_dir,0755);////make directory
					$names=array($temp,$friend);
					sort($names);
					
					
					$first=$names[0];
					echo $first;
					$second=$names[1];
					echo $second;
					$filename=$target_dir.'/'.$first.'_'.$second.'.html';
					echo $filename;
					$handle = fopen($filename, "w");
				    $contents = fread($handle, filesize($filename));
				    fclose($handle);     
				    echo $contents;
			}
			//echo'</textarea>';
		echo "</div>";//div chatbox closes
		echo "<form name='message' action=''>";
		        echo "<input name='usermsg' type='text' id='usermsg' size='63' />";
		        echo "<input name='submitmsg' type='submit'  id='submitmsg' value='Send' />";
				echo "<br>";	
		echo "</form>";
	echo "</div>";// div menu closes
echo "</div>"; // body og JQM closes
if(isset($_GET['logout']))
{
	$email1=$_SESSION['email'];
	 $fp = fopen($filename, 'a');
    fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['name'] ." has left the chat session.</i><br></div>");
    fclose($fp);
    //session_destroy();
	//$temp = NULL; header("Location: homepage.php?name='.$temp.'");	
    header("Location: homepage.php?chat=true");	
	die();
}
}
else
{
	//header("Location: frontpage.html");
	echo '<script>window.location="http://localhost/220_final/frontpage.html";</script>';
	die();
}
?>
<script type="text/javascript">
$(function() {
	var d=new Date();
			var dateAsObject;
			var dateAsObject1;
		$("#dateborrowedlent1").mousedown(function(){
    	$("#dateborrowedlent1" ).datepicker({onSelect: function(dateText1, inst) { 
      var dateAsString1 = dateText1; //the first parameter of this function
      dateAsObject1 = $(this).datepicker( 'getDate' ); //the getDate method
	  var diff=(Math.round(dateAsObject1-d)/(1000*24*60*60));

	  if(diff>0)
	  {
		  dateAlert("Please do not enter future date");
		  $("#dateborrowedlent1").val('');
		  $("#expectedreturndate1").val('');
		  dateAsObject=null;
		  dateAsObject1=null;
		   $("#dateborrowedlent1").html('');
		  $("#expectedreturndate1").html('');
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
		
		$("#expectedreturndate1").mousedown(function(){
    	$( "#expectedreturndate1" ).datepicker({onSelect: function(dateText, inst) { 
      var dateAsString = dateText; //the first parameter of this function
      dateAsObject = $(this).datepicker( 'getDate' ); //the getDate method
	  //console.log(dateAsObject.getDate());

	  var diff1= Math.ceil((dateAsObject-d)/(1000*24*60*60));
	  if(diff1 <0) //check if the expected date is a future date and not past date
	  {

		  dateAlert("Please do not enter a prior date");
		  $("#dateborrowedlent1").val('');
		  $("#expectedreturndate1").val('');
		  dateAsObject=null;
		  dateAsObject1=null;
		   $("#dateborrowedlent1").html('');
		  $("#expectedreturndate1").html('');
	  }
	  else if(!(dateAsObject1)) //check if the lent date is filled before enterign the expected date
	  {
		  dateAlert("Please enter the lent date");
		  $("#dateborrowedlent1").val('');
		  $("#expectedreturndate1").val('');
		   dateAsObject=null;
		  dateAsObject1=null;
		  
	  }
	  else
	  {
		var days=Math.round((dateAsObject-dateAsObject1)/(1000*60*60*24));
		if(days<0)
		{
		  alert("Expected return date cannot be less than borrowed/lent date;");
		  $("#dateborrowedlent1").val('');
		  $("#expectedreturndate1").val('');
		   $("#dateborrowedlent1").html('');
		  $("#expectedreturndate1").html('');
		  dateAsObject=null;
		  dateAsObject1=null;
		}
	}
	
   }
}); });
		
  	});
	
$(document).ready(function(){
	$("#exit").click(function(){
		//var exit=confirm("Are you sure you want to Exit Chat");
		//if(exit == true)
		//{
			window.location='jurochat.php?logout=true';
		//}
	});
});

$(document).ready(function(){
	$("#back").click(function(){
		
			window.open("http://localhost/220_final/homepage.php?chat=true");
		
	});
});

$(document).ready(function(){
	$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		var file='<?php echo $filename?>';
		$.post("juropost.php", {text: clientmsg,filename:file});				
		$('#usermsg').val('');
		return false;
	});
 
});
$(document).ready(function(){
	$("#shareAndRemind1").submit(function(){
	//alert("Shill");
	var dataShare = $('#shareAndRemind1').serialize();
	//alert(dataShare);
	$.ajax({
		url: "shareandremind.php",
		type: "POST",
		data: dataShare,
		dataType: 'json',
		success: function(data) 
		{  
			if (data.status == 401)
			{
				console.log(data);
				//alert("Inside failure");
				$('#displayshareAndRemind1').html(data.msg).show(1000);  
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
			$('#displayshareAndRemind1').html(data.msg).show(1000);
		}
	}); 
	return false; 
	});
});
setInterval (loadLog, 200);	
function loadLog(){		
var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
		$.ajax({
			url: "<?php echo $filename?>",
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); //Insert chat log into the #chatbox div
//Auto-scroll			
				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
				if(newscrollHeight > oldscrollHeight){
					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}								
		  	},
		});
	}
</script>

<div data-role="popup" id="popupBasic3" data-transition="pop" data-theme="a" class="ui-corner-all">		    
	<form action="shareandremind.php" method="post" name="shareAndRemind" id="shareAndRemind1">
	<div style="padding:10px 20px;">

			    		<h3>Please fill your details..</h3>

				    	 <input type="text" name="owner" id="yourname1" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" placeholder="Username" readonly data-theme="a" />
						<input type="text" name="remindto" id="remindto1" value="" placeholder="Remind To" required data-theme="a" />

						 <input type="text" name="itemborrowedlent" id="itemborrowedlent1" value="" placeholder="Item Borrowed/Lent" required data-theme="a"/>

						
						  <input type="text" name="dateborrowedlent" id="dateborrowedlent1"  placeholder="Date Borrowed/Lent" required data-theme="a" />

						  <input input type="text" name="expectedreturndate" id="expectedreturndate1"  placeholder="Expected Return Date" data-theme="a" />				 

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
<div id="displayshareAndRemind1" style="color:red"></div>

<div data-role='footer'>
	<h2>&copy; CMPE220 JuRoCHAT Fall'15</h2>
</div>
</div> <!--page div closes-->
</body>
</html>