<?php 
session_start();

include_once "./database.php";

function get_ip(){
    $client  = $_SERVER['HTTP_CLIENT_IP'];
    $forward = $_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
    elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
    else $ip = $remote;

    return $ip;
}
if (!empty($_SESSION['phone']))
    $user_phone = "+7".$_SESSION['phone'];
else
    $user_phone = "+7".$_COOKIE['phone'];


if (empty($_SESSION['auth']) or $_SESSION['auth'] == false) {
    if ( !empty($_COOKIE['phone']) and !empty($_COOKIE['cookie_key']) ) {

        if ($dbconnect->connect_error) {    
            die("Database connection failed: " . $dbconnect->connect_error);    // Проверка на подключение
          }

        // Полученме куки из БД

        $query = 'SELECT * FROM Users WHERE Phone="'.$_COOKIE['phone'].'"'; // Получение телефона пользователя исходя из куки
        $user = mysqli_fetch_assoc(mysqli_query($dbconnect, $query)); 

        $salt = $user['Salt'];  //соль для куки
        $Ip = get_ip(); //IP для куки

        $phone = $_COOKIE['phone'];
        $coockie_key = md5($_COOKIE['cookie_key'].$Ip.$salt);

        $query = 'SELECT * FROM Users WHERE Phone="'.$phone.'" AND Cookie="'.$coockie_key.'"'
            or die (mysqli_error($dbconnect));
        $result = mysqli_fetch_assoc(mysqli_query($dbconnect, $query)); 
        echo $result;

        if (empty($result)) {
            header("Location: ../index.php");
        }
    }
    else{
        header("Location: ../index.php");
    }

}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet"> 
    <title>Профиль</title>
</head>
<body>
    <div class="content-wrapper">
        <p>HELLO, <?php 
            echo $user_phone. "<br>";
            echo $_SERVER['REMOTE_ADDR'];?>
        </p>

        <div class="logout">
            <a href="../../php/logout.php" class="logout__link"> Выйти из аккаунта </a>
        </div>	
    </div>
    


</body>
</html>