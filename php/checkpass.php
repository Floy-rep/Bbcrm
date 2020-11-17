<?php
session_start();

include_once "./functions.php";
include_once "./database.php";

$phone = $_REQUEST['phone']; 
if ($phone[0] == "+")
    $phone = mb_strimwidth($phone, 2, 10);
else if ($phone[0] == "7" || $phone[0] == "8")
    $phone = mb_strimwidth($phone, 1, 10);

$query = mysqli_query($dbconnect, 'SELECT * FROM Users WHERE Phone="'.$phone.'"')
   or die (mysqli_error($dbconnect));
$user = mysqli_fetch_assoc($query);

if (!empty($user)){

    $password = $_REQUEST['password'];
    $salt = $user['Salt'];
    $salted_password = $user['Password'];

    if (md5($password.$salt) == $salted_password){

        session_start();
        $cookie_key = generateSalt(15);
        $saltedCookie = md5($cookie_key.get_ip().$salt);

        setcookie("phone", $phone, time() + 3600 * 24 * 7, '/');
        setcookie("cookie_key", $cookie_key,  time() + 3600 * 24 * 7, '/');
        $_SESSION['auth'] = true;
        $_SESSION['Phone'] = $phone;

        $query = 'UPDATE Users SET Cookie="'.$saltedCookie.'" WHERE Id="'.$user['Id'] .'"';
        mysqli_query($dbconnect, $query);

        header("Location: ../Pages/Profile/profile.php");
    }
    else{
        $_SESSION['text_message'] = "Введен не правильный пароль*";
        header("Location: ../Pages/SignIn/signin.php");
    }
}
else{
    $_SESSION['text_message'] = "Данная учетная запись не найдена*";
    header("Location: ../Pages/SignIn/signin.php");
}



 ?>
