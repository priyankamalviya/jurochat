<?php
//require_once('phar:///var/www/path-to/PhpConsole.phar'); // autoload will be initialized automatically
session_start();
session_destroy();
header('Location:http://localhost/220_final/frontpage.html?logout=true',true,302); exit();
//if(session_destroy()) // Destroying All Sessions
//{
//header("Location: frontpage.html");
//}
?>		