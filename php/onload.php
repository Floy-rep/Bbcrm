<?php

function get_ip(){
    $client  = $_SERVER['HTTP_CLIENT_IP'];
    $forward = $_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
    elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
    else $ip = $remote;

    return $ip;
}


function checkAuth($linkdb, $linkprofile, $linksignin)
{
    include_once $linkdb;

    $phone_cookie = $_COOKIE['phone']; 
        if ($phone_cookie[0] == "+")
            $phone_cookie = mb_strimwidth($phone_cookie, 2, 10);
        else if ($phone_cookie[0] == "7" || $phone_cookie[0] == "8")
            $phone_cookie = mb_strimwidth($phone_cookie, 1, 10);

    if (empty($_SESSION['auth']) or $_SESSION['auth'] == false) {
        if ( !empty($phone_cookie) and !empty($_COOKIE['cookie_key']) ) {

            if ($dbconnect->connect_error) {    
                die("Database connection failed: " . $dbconnect->connect_error);    // Проверка на подключение
              }

            // Полученме куки из БД

            $query = 'SELECT * FROM Users WHERE Phone="'.$phone_cookie.'"'; // Получение телефона пользователя исходя из куки
            $user = mysqli_fetch_assoc(mysqli_query($dbconnect, $query)); 
            $salt = $user['Salt'];  //соль для куки
            $Ip = get_ip(); //IP для куки

            $phone = $phone_cookie;
            $coockie_key = md5($_COOKIE['cookie_key'].$Ip.$salt);

            $query = 'SELECT * FROM Users WHERE Phone="'.$phone.'" AND Cookie="'.$coockie_key.'"'
                or die (mysqli_error($dbconnect));
            $result = mysqli_fetch_assoc(mysqli_query($dbconnect, $query)); 

            if (!empty($result)) {
                session_start(); 
                $_SESSION['auth'] = true; 
                $_SESSION['Phone'] = $user['Phone'];
                header("Location: ". $linkprofile);
            }
                // $_SESSION['']
        }
        else{
            if ($linksignin != "none")
                header("Location: ". $linksignin);
        }
    }
    else if ($_SESSION['auth'] == true || $_SESSION['auth'] == 1){
        header("Location: ". $linkprofile);
        // header("Location: php/profile.php");
    }
}



?>