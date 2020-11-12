<?php
// DATA BASE PASSWORD WEBHOST000 : 2iuCGCNzd0!0I8EA

// VAR 
$Request_accepted = FALSE;

//LOCAL MACHINE
$hostname = "localhost";
$username = "floy";
$password = "floy2310";
$db = "test";

//WEBHOST000
// $hostname = "localhost";
// $username = "id11013241_floy";
// $password = "2iuCGCNzd0!0I8EA";
// $db = "id11013241_test";

$dbconnect=mysqli_connect($hostname,$username,$password,$db);

if ($dbconnect->connect_error) {
  die("Database connection failed: " . $dbconnect->connect_error);
}

$query = mysqli_query($dbconnect, "SELECT * FROM Users")
   or die (mysqli_error($dbconnect));

while ($row = mysqli_fetch_array($query)) {
    if ($_POST['phone'] == $row['Phone'] && $_POST['password'] == $row['Password'])
    {
        $Request_accepted = TRUE;
    }
    echo "ID " .  $row['Id'] . "<br>";
    echo "Phone " . $row['Phone'] . "<br>";
    echo "Password " . $row['Password'] . "<br>";
}


if ($Request_accepted == TRUE){
    session_start();
    $_SESSION['accepted'] = "form__goodrequest";
}
else{
    session_start();
    $_SESSION['dinied'] = "form__badrequest";
}

header("Location: ../Pages/SignIn/signin.php");

 ?>
