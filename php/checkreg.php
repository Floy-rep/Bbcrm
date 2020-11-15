<?php
    session_start();

    include_once "./functions.php";
    include_once "./database.php";

    if ($dbconnect->connect_error) {
        die("Database connection failed: " . $dbconnect->connect_error);
      }

    $secret_pass = "0000";

    if (!empty($_REQUEST['message']) and $_REQUEST['message'] == $secret_pass)
    {
        $phone = $_REQUEST['phone']; 
        if ($phone[0] == "+")
            $phone = mb_strimwidth($phone, 2, 10);
        else if ($phone[0] == "7" || $phone[0] == "8")
            $phone = mb_strimwidth($phone, 1, 10);
		$password = $_REQUEST['password']; 
        $password_confirm = $_REQUEST['password_confirm'];
        
        if ($password == $password_confirm){

            $query = 'SELECT*FROM Users WHERE Phone="'.$phone.'"';
            $isPhoneRegistered = mysqli_fetch_assoc(mysqli_query($dbconnect, $query));
            if (empty($isPhoneRegistered)){

                $salt = generateSalt(8); 
                $saltedPassword = md5($password.$salt); 
                $cookie_key = generateSalt(15);

                $saltedCookie = md5($cookie_key.get_ip().$salt);
                
                setcookie("phone", $phone, time() + 3600 * 24 * 7, '/');
                setcookie("cookie_key", $cookie_key, time() + 3600 * 24 * 7, '/');

                $_SESSION['auth'] = true;
                $_SESSION['Phone'] = $phone;

                $query = 'INSERT INTO Users SET Phone="'.$phone.'", 
					Password="'.$saltedPassword.'", Salt="'.$salt.'", Cookie="'.$saltedCookie.'"';
                mysqli_query($dbconnect, $query) or header("Location: ./signup.php");
                
                header("Location: ./profile.php");

            }
            else{
                $_SESSION['text_message'] = "Вы уже зарегистрированы*";
                header("Location: ../Pages/SignUp/signup.php");
            }
        }
        else{
            $_SESSION['text_message'] = "Пароли не одинаковые*";
            header("Location: ../Pages/SignUp/signup.php");
        }
    }
    else{
        $_SESSION['text_message'] = "Секретный код не действителен*";
        header("Location: ../Pages/SignUp/signup.php");
    }

    
?>