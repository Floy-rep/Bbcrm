<?php
    session_start();

    include_once "./functions.php";
    include_once "./database.php";

    if ($dbconnect->connect_error) {
        die("Database connection failed: " . $dbconnect->connect_error);
        }

    $phone = $_REQUEST['phone']; 
    if ($phone[0] == "+")
        $phone = mb_strimwidth($phone, 2, 10);
    else if ($phone[0] == "7" || $phone[0] == "8")
        $phone = mb_strimwidth($phone, 1, 10);

    $query = 'SELECT*FROM Users WHERE Phone="'.$phone.'"';
    $isPhoneRegistered = mysqli_fetch_assoc(mysqli_query($dbconnect, $query));
    if (!empty($isPhoneRegistered)){

        $_SESSION['Phone'] = $phone;

        //ОТПРАВКА СООБЩЕНИЙ
        if (empty($_SESSION['codeForChange']))
        {
            $code = rand(10000, 99999);
            $_SESSION['codeForChange'] = $code;
        
            require_once './sms.ru.php';
        
            $smsru = new SMSRU('12438D0A-5537-20D0-624C-CC7D59793651'); 
            $data = new stdClass();
            $data->to = "7".$phone;
            $data->text = $code; 
            $sms = $smsru->send_one($data);
        }
        header("Location: ../Pages/PasswordBackup/PasswordBackUp_confirm.php");

    }
    else{
        $_SESSION['text_message'] = "Аккаунт не найден*";
        header("Location: ../Pages/SignUp/signup_data.php");
    }
    
?>