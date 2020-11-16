<?php
include_once "../../php/onload.php";
checkAuth("../../php/database.php", "../../php/profile.php", "none");

session_start();
$text = $_SESSION['text_message'];
unset($_SESSION['text_message']);
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css" type="text/css">
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
                <a href="./signup_data.php" title="Ввести другие учетные данные"> Назад </a>
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
            <form class="form" method="POST" action="../../php/checkreg_stage2.php" name="form">
                <div class="form__element">
                    <span>Телефон</span>
                    <input id="phone" class="form__input" name="phone" type="text" placeholder="+79040992573"
                    pattern="\+79[0-9]{9}|8[0-9]{10}|79[0-9]{9}" readonly value="<?php echo "+7".$_SESSION['Phone']?>">
                </div>
                <div class="form__element">
                    <span>Пароль</span>
                    <div class="form__password">
                        <input type="password" id="first-password-input" class="form__input" placeholder="Введите пароль" name="password" readonly value="<?php echo $_SESSION['pass']?>"> 
                        <a href="#" id="password-first-check" class="password-first-check password-control"></a>
                    </div>
                </div>
                <div class="form__element">
                    <span>Потверждение пароля</span>
                    <div class="form__password">
                        <input type="password" id="second-password-input" class="form__input" placeholder="Потвердите пароль" name="password_confirm" readonly  value="<?php echo $_SESSION['pass']?>"> 
                        <a href="#" id="password-second-check" class="password-second-check password-control" ></a>
                    </div>
                </div>
                <div class="form__element">
                    <span>Код смс</span>
                        <div class="form__message">
                            <input type="text" id="pass-from-message" class="message-input" placeholder="Код" name="message" maxlength="7"> 
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