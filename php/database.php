<?php

//LOCAL MACHINE WINDOWS

$hostname = "localhost";
$username = "root";
$password = "root";
$db = "test";

//LOCAL MACHINE LINUX
// $hostname = "localhost";
// $username = "floy";
// $password = "floy2310";
// $db = "test";

//WEBHOST000
// $hostname = "localhost";
// $username = "id11013241_floy";
// $password = "2iuCGCNzd0!0I8EA";
// $db = "id11013241_test";

$dbconnect=mysqli_connect($hostname,$username,$password,$db);

?>