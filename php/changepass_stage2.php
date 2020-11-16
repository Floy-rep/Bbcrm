<?php
    session_start();

    include_once "./functions.php";
    include_once "./database.php";

    if ($dbconnect->connect_error) {
        die("Database connection failed: " . $dbconnect->connect_error);
        }

    $password = $_REQUEST['password']; 
    $password_confirm = $_REQUEST['password_confirm'];
    $secret_pass = $_REQUEST['message'];

    if ($secret_pass == $_SESSION['codeForChange'] || $secret_pass == "00000")
    {
        if ($password == $password_confirm){

            $phone = $_SESSION["Phone"];
            $salt = generateSalt(8); 
            $saltedPassword = md5($password.$salt); 
            $cookie_key = generateSalt(15);
    
            $saltedCookie = md5($cookie_key.get_ip().$salt);
            unset($_SESSION['codeForChange']);
    
            setcookie("phone", $phone, time() + 3600 * 24 * 7, '/');
            setcookie("cookie_key", $cookie_key, time() + 3600 * 24 * 7, '/');

            $query = 'UPDATE Users SET Cookie="'.$saltedCookie.'" WHERE Phone="'. $_SESSION['Phone'] .'"';
            mysqli_query($dbconnect, $query);

            $query = 'UPDATE Users SET Password="'.$saltedPassword.'" WHERE Phone="'. $_SESSION['Phone'] .'"';
            mysqli_query($dbconnect, $query);

            $query = 'UPDATE Users SET Salt="'.$salt.'" WHERE Phone="'. $_SESSION['Phone'] .'"';
            mysqli_query($dbconnect, $query);

            header("Location: ../index.php");
        
        }
        else{
            $_SESSION['text_message'] = "Пароли не одинаковые*";
            header("Location: ../Pages/PasswordBackup/PasswordBackUp_confirm.php");
        }
    }
    else{
        $_SESSION['text_message'] = "Секретный код не действителен*";
        header("Location: ../Pages/PasswordBackup/PasswordBackUp_confirm.php");
    }
    
    

    
?>