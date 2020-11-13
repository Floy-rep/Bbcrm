<?php
session_start();
$text = $_SESSION['text_message'];
$text = "123123";

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
    <title>Sign Up</title>
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
            <h1 class="main__title">Регистрация</h1>
            <form class="form" action="Post">
                <div class="form__element">
                    <span>Телефон</span>
                    <input id="phone" name="phone" type="text" placeholder="+79040992573"
                    pattern="\+79[0-9]{9}|8[0-9]{10}" required> 
                </div>
                <div class="form__element">
                    <span>Пароль</span>
                    <div class="form__password">
                        <input type="password" id="first-password-input" placeholder="Введите пароль" name="password" required> 
                        <a href="#" id="password-first-check" class="password-first-check password-control" onclick="return show_hide_password(this);"></a>
                    </div>
                </div>
                <div class="form__element">
                    <span>Потверждение пароля</span>
                    <div class="form__password">
                        <input type="password" id="second-password-input" placeholder="Потвердите пароль" name="password" required> 
                        <a href="#" id="password-second-check" class="password-second-check password-control" onclick="return show_hide_password(this);"></a>
                    </div>
                </div>
                <div class="form__element">
                    <span>Код смс</span>
                    <div class="form__message">
                        <input type="text" id="pass-from-message" class="message-input" placeholder="Код" name="message" required maxlength="6"> 
                        <a href="#" class="form__link-message" onclick="return send_message(this);">Отправить смс</a>
                    </div>
                </div>

                <?php
                    if(!isset($text))
                    {

                    }
                    else
                    {
                        echo"<div class= 'form__errormessage'> 
                        <p> $text </p>
                        </div>"
                        
                        ;
                    }
                ?>

                <p class="form__text">
                    Регистрируясь, вы подтверждаете, что принимаете <a href="#">Пользовательское соглашение </a> и даете <a href="#">Согласие на обработку персональных данных.</a> 
                </p>
                <hr>
                <input class="form__submit" type="submit" value="Начать бесплатно" title="Зарегистрироваться" name="submit"> 
            </form>

            <div class="main__link-div">
                <span>Уже есть аккаунт</span>
                <a class="main__link main__new-account" href="../SignIn/signin.php" title="Войти в существующий аккаунт">Войти</a>
            </div>
            <a class="main__link main__new-pass" href="../PasswordBackup/PasswordBackUp.php" title="Форма восстановления пароля">Восстановить пароль</a>
        </section>
    </main>   
    
    <script src="script.js"></script>
    
</body>
</html>