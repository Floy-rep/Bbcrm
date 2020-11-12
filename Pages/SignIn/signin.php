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
                <a href="../../index.html" title="Вернуться на главную страницу"> Вернуться на сайт</a>
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
                        <a href="#" id="password-first-check" class="password-first-check password-control" onclick="return show_hide_password(this);"></a>
                    </div>
                </div>
                
                <p id= "<?php
                    session_start();
                    echo $_SESSION['dinied'];
                    session_reset();

                    ?>" class="form__info">  Неверно введен логин или пароль*</p> 
                
                <p id= "<?php
                    session_start();
                    echo $_SESSION['accepted'];
                    session_destroy();


                    ?>" class="form__info">  Вы успешно зашли в учетную запись!*</p> 

                <input class="form__submit" type="submit" value="Войти" title="Войти в систему">
            </form>
            

            <a class="main__link main__new-account" href="../SignUp/signup.html" title="Зарегистрировать новый аккаунт">Создать аккаунт</a>
            <a class="main__link main__new-pass" href="../PasswordBackup/PasswordBackUp.html" title="Форма восстановления пароля">Восстановить пароль</a>
        </section>
    </main>    
    <script src="script.js"></script>
</body>
</html>