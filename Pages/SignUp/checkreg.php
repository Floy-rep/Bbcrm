<?php
    session_start();
    function generateSalt($len)
    {
        $salt = '';
        for($i=0; $i<$len; $i++) {
            $salt .= chr(mt_rand(33,126)); //символ из ASCII-table
        }
        return $salt;
    }

    function get_ip(){
        $client  = $_SERVER['HTTP_CLIENT_IP'];
        $forward = $_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];
    
        if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
        elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
        else $ip = $remote;
    
        return $ip;
    }

    include_once "../../php/database.php";

    if ($dbconnect->connect_error) {
        die("Database connection failed: " . $dbconnect->connect_error);
      }

    $secret_pass = "0000";

    if (!empty($_REQUEST['message']) and $_REQUEST['message'] == $secret_pass)
    {
        $phone = $_REQUEST['phone']; 
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
                setcookie("coockie_key", $cookie_key, time() + 3600 * 24 * 7, '/');

                $_SESSION['auth'] = true;
                $_SESSION['Phone'] = $phone;

                $query = 'INSERT INTO Users SET Phone="'.$phone.'", 
					Password="'.$saltedPassword.'", Salt="'.$salt.'", Cookie="'.$saltedCookie.'"';
                mysqli_query($dbconnect, $query) or header("Location: ./signup.php");; 
                
                header("Location: ../../php/profile.php");

            }
            else{
                $_SESSION['text_message'] = "Вы уже зарегистрированы*";
                header("Location: ./signup.php");
            }
        }
        else{
            $_SESSION['text_message'] = "Пароли не одинаковые*";
            header("Location: ./signup.php");
        }
    }
    else{
        $_SESSION['text_message'] = "Секретный код не действителен*";
        header("Location: ./signup.php");
    }

    
?>