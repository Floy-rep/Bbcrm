<?php
include_once "../../php/onload.php";
checkAuth("../../php/database.php", "../../php/profile.php");

session_start();
$text = $_SESSION['text_message'];
unset($_SESSION['text_message']);

//ОТПРАВКА СООБЩЕНИЙ

// require_once '../../php/sms.ru.php';

// $smsru = new SMSRU('12438D0A-5537-20D0-624C-CC7D59793651'); 
// $data = new stdClass();
// $data->to = '79040992573';
// // $data->to = '89202098077';
// $data->text = 'DAROVA EPTA BANDIT'; 
// $sms = $smsru->send_one($data);

// if ($sms->status == "OK") { // Запрос выполнен успешно
//     echo "Сообщение отправлено успешно. ";
//     echo "ID сообщения: $sms->sms_id. ";
//     echo "Ваш новый баланс: $sms->balance";
// } else {
//     echo "Сообщение не отправлено. ";
//     echo "Код ошибки: $sms->status_code. ";
//     echo "Текст ошибки: $sms->status_text.";
// }

?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500;700&display=swap" rel="stylesheet"> 
    <link rel="shortcut icon" href="../../img/ico_bbcrm.ico" type="image/x-icon">
    <title>Sign In</title>
</head>

<body>
    <main class="main">
        <section class="main__block">
            
            <div class="main__back">
                <img src="img/arrow.png" alt="Not found">
                <a href="../../index.php" title="Вернуться на главную страницу"> Вернуться на сайт</a>
            </div>

            <div class="text">
                <h2 class="text__title">
                    Помогаем бизнесу работать
                </h2>
                <hr>
                <p class="text__subtitle">
                    Эффективное решение для ведения дела
                </p>
            </div>
        </section>
        <section class="main__block main__form">
            <h1 class="main__title">Вход в BBcrm</h1>
            <form class="form" method="POST" action="../../php/checkpass.php">
                <div class="form__element">
                    <span>Телефон</span>
                    <input type="text" placeholder="+7 (904) 099-25-73" name="phone" required> 
                </div>
                <div class="form__element">
                    <span>Пароль</span>
                    <div class="form__password">
                        <input type="password" id="first-password-input" placeholder="Введите пароль" name="password" required> 
                        <!-- <a href="#" id="password-first-check" class="password-first-check password-control hide" onclick="return show_hide_password(this);"></a> -->
                        <a href="#" id="password-first-check" class="password-first-check password-control hide" onclick="<?php echo "lol"; ?>"></a>
                    </div>
                </div>

                <?php
                    if(isset($text))
                    {
                        echo"<div class= 'form__errormessage'> 
                        <p> $text </p>
                        </div>";
                    }
                ?>
                <input class="form__submit" type="submit" value="Войти" title="Войти в систему">
            </form>
            

            <a class="main__link main__new-account" href="../SignUp/signup.php" title="Зарегистрировать новый аккаунт">Создать аккаунт</a>
            <a class="main__link main__new-pass" href="../PasswordBackup/PasswordBackUp.php" title="Форма восстановления пароля">Восстановить пароль</a>
        </section>
    </main>    
    <script src="script.js"></script>
</body>
</html>