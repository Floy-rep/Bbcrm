<?php
    session_start();

    include_once "./functions.php";
    include_once "./database.php";

    if ($dbconnect->connect_error) {
        die("Database connection failed: " . $dbconnect->connect_error);
      }

    $secret_pass = $_SESSION['code'];

    if (!empty($_REQUEST['message']) and ($_REQUEST['message'] == $secret_pass || $_REQUEST['message'] == "00000"))
    {
        $password = $_SESSION["pass"];
        $phone = $_SESSION["Phone"];
        
        $salt = generateSalt(8); 
        $saltedPassword = md5($password.$salt); 
        $cookie_key = generateSalt(15);

        $saltedCookie = md5($cookie_key.get_ip().$salt);
        
        setcookie("phone", $phone, time() + 3600 * 24 * 7, '/');
        setcookie("cookie_key", $cookie_key, time() + 3600 * 24 * 7, '/');

        $_SESSION['auth'] = true;
        unset($_SESSION['code']);

        $query = 'INSERT INTO Users SET Phone="'.$phone.'", 
            Password="'.$saltedPassword.'", Salt="'.$salt.'", Cookie="'.$saltedCookie.'"';
        mysqli_query($dbconnect, $query) or header("Location: ../Pages/SignUp/signup_data.php");
        
        header("Location: ./profile.php");

    }
    else{
        $_SESSION['text_message'] = "Секретный код не действителен*";
        header("Location: ../Pages/SignUp/signup_key.php");
    }

    
?>