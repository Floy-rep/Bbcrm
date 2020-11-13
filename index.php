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

include_once 'php/database.php';
// setcookie('phone', '7979040992573');

if (empty($_SESSION['auth']) or $_SESSION['auth'] == false) {

    // if ( !empty($_COOKIE['phone']) and !empty($_COOKIE['key']) ) {
    if ( !empty($_COOKIE['phone'])) {

        if ($dbconnect->connect_error) {    
            die("Database connection failed: " . $dbconnect->connect_error);    // Проверка на подключение
          }

        // Полученме куки из БД

        $query = 'SELECT * FROM Users WHERE Phone="'.$_COOKIE['phone'].'"'; // Получение телефона пользователя исходя из куки
        $user = mysqli_fetch_assoc(mysqli_query($dbconnect, $query)); 

        $salt = $user['Salt'];  //соль для куки
        $Ip = get_ip(); //IP для куки

        $login = $_COOKIE['phone'];
        $coockie_key = md5($_COOKIE['coockie_key'].$Ip.$salt);

        $query = 'SELECT * FROM Users WHERE Phone="'.$phone.'" AND Cookie="'.$coockie_key.'"'
            or die (mysqli_error($dbconnect));
        $result = mysqli_fetch_assoc(mysqli_query($dbconnect, $query)); 

        if (!empty($result)) {
            session_start(); 
            $_SESSION['auth'] = true; 
            $_SESSION['Phone'] = $user['Phone'];
            header("Location: php/profile.php");
        }
            // $_SESSION['']
    }
}
else if ($_SESSION['auth'] == true){
    header("Location: php/profile.php");
}

?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500;700&display=swap" rel="stylesheet"> 
    <link rel="shortcut icon" href="img/ico_bbcrm.ico" type="image/x-icon">
    <title>bbcrm</title>
</head>
<body>
    <main>
        <header class="header-wrapper">
            <div id="fixed-wrapper" class="">
            </div>
            <div class="header" id="header">
                <div id="fixed" class="header__fixed">
                    <div class="header__logo">
                        <img src="img/logo.png" title="Bbcrm" alt="Not Found">
                    </div>
                    <div class="links">
                        <a href="#about" title="Что такое BBcrm?" class="links__link">О ПРОГРАММЕ</a>
                        <a href="#ability" title="Восемь основных возможностей BBcrm" class="links__link">ВОЗМОЖНОСТИ</a>
                        <a href="#tariff" title="Тарифы на пользование BBcrm системы" class="links__link">ТАРИФЫ</a>
                    </div>
                    <div class="header__about">
                        <a class="header__item" title="Позвони нам, оператор всегда на связи" href="tel:88005002138">8 800 500-21-38</a>
                        <form class="header__form" action="Pages/SignUp/signup.php">
                            <button type="submit" class="header__about-button" title="Пройти быструю регистрацию">РЕГИСТРАЦИЯ</button>
                        </form>
                        <a class="header__item" title="Войти в аккаунт" href="Pages/SignIn/signin.php">ВОЙТИ</a>
    
                        <div id="burger" class="burger">
                            <span class="burger__line"></span>
                            <span class="burger__line"></span>
                            <span class="burger__line"></span>
    
                            <div class="burger__menu" id="burger__menu">
    
                                <div class="burger__about">
                                    <a class="burger__item" title="Позвони нам, оператор всегда на связи" href="tel:88005002138">8 800 500-21-38</a>
                                    <form action="Pages/SignUp/signup.php">
                                        <button type="submit" class="burger__about-button" title="Пройти быструю регистрацию">РЕГИСТРАЦИЯ</button>
                                    </form>
                                    <a class="burger__item" title="Войти в аккаунт" href="Pages/SignIn/signin.php">ВОЙТИ</a>
                                </div>
    
                                <div class="links">
                                    <a href="#about" title="Что такое BBcrm?" class="links__link">О ПРОГРАММЕ</a>
                                    <a href="#ability" title="Восемь основных возможностей BBcrm" class="links__link">ВОЗМОЖНОСТИ</a>
                                    <a href="#tariff" title="Тарифы на пользование BBcrm системы" class="links__link">ТАРИФЫ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  


                <div class="header__content"> 
                    <h1 class="header__title">Программа <br> для автомагазинов</h1>
                    <p class="header__subtitle">Помогает вести учет склада, увеличивает <br> продажи, экономит деньги и время</p>

                    <form action="Pages/SignUp/signup.php">
                        <button class="header__button" title="Закажите прямо сейчас!">
                            <span>ПОЛУЧИТЬ БЕСПЛАТНО</span>    
                        </button>
                    </form>
                    
                </div>
                
                <div class="header__img" id='header_img'>
                    <img src="img/header_box_test.png" alt="Not Found">
                </div>
            </div>
        </header>

        <div class="whatisit-wrapper">
            <a id="about" ></a>
            <div class="whatisit">
                <div class="whatisit__img">
                    <img src="img/monitor/mon.jpg" title="Как будет выглядеть" alt="Not Found">
                </div>
                <article class="whatisit__top">
                    <h2>Что такое BBcrm</h2>
                    <p class="whatisit__subtitle">
                        Это онлайн-программа для эффективной работы автомагазина. В ней учтены большинство необходимых функций, облегчающих работу менеджеров и директоров. <br><br>
                        Продукт не требует платного внедрения в ваш бизнес и рассчитан на работу как с одним, так и с несколькими магазинами.
                    </p>
                </article>
                <div class="whatisit__help">
                    <p class="whatisit__text">
                        Проверьте, подходит ли вам BBcrm — <span> получите 14 дней и помощь специалиста бесплатно </span>
                    </p>
                </div> 
            </div>
        </div>

        <div class="abilities-wrapper">
            <a id="ability" ></a>
            <div class="alilities">
                <h2>Возможности BBcrm</h2>
                <section class="item">
                    <div class="item__left">
                        <img src="img/ability.png" alt="Not Found">
                        <span class="item__number"> 1 </span>
                    </div>
                    <div class="item__row">
                        <h5 class="item__title">Ведение склада</h5>
                         <p class="item__subtitle">Полноценный складской учет, контроль остатков, оформление поступлений и возвратов, составление заявок поставщикам. <br><br> BBcrm напомнит вам о критическом остатке товара на складе, чтобы своевременно пополнить запасы.</p>
                    </div>
                </section>

                <section class="item">
                    <div class="item__left">
                        <img src="img/ability.png" alt="Not Found">
                        <span class="item__number"> 2 </span>
                    </div>
                    <div class="item__row">
                        <h5 class="item__title">Клиенты и продажи</h5>
                         <p class="item__subtitle">Ведение клиентской базы, удобный поиск постоянных клиентов, добавление новых, статистика продаж каждого менеджера и покупок клиента как со склада, так и заказных позиций. <br><br> При оформлении продажи и получении оплаты, BBcrm создаст приходный ордер в разделе «Финансы».</p>
                    </div>
                </section>

                <section class="item">
                    <div class="item__left">
                        <img src="img/ability.png" alt="Not Found">
                        <span class="item__number"> 3 </span>
                    </div>
                    <div class="item__row">
                        <h5 class="item__title">СМС уведомления клиентов</h5>
                         <p class="item__subtitle">Больше не нужно беспокоиться о том, что телефон клиента недоступен или ваш сотрудник просто забыл ему позвонить. Функция СМС-оповещения поможет значительно сэкономить время менеджеров на обслуживании клиента. BBcrm система автоматически отправит клиенту сообщение об изменении   статуса заказа: «Заказ принят», «Заказ прибыл», «Заказ отменен».</p>
                    </div>
                </section>

                <section class="item">
                    <div class="item__left">
                        <img src="img/ability.png" alt="Not Found">
                        <span class="item__number"> 4 </span>
                    </div>
                    <div class="item__row">
                        <h5 class="item__title">Доходы и расходы</h5>
                         <p class="item__subtitle">Все денежные операции в одном разделе. С помощью удобного фильтра, вы сможете увидеть расчеты за выбранный период или вывести отчет по конкретному сотруднику.</p>
                    </div>
                </section>

                <section class="item">
                    <div class="item__left">
                        <img src="img/ability.png" alt="Not Found">
                        <span class="item__number"> 5 </span>
                    </div>
                    <div class="item__row">
                        <h5 class="item__title">Расчет заработной платы</h5>
                         <p class="item__subtitle">Добавьте сотрудников, настройте автоматический расчет размера заработной платы. Можете указать фиксированный оклад, оклад + проценты от продаж или проценты от продаж без оклада.</p>
                    </div>
                </section>

                <section class="item">
                    <div class="item__left">
                        <img src="img/ability.png" alt="Not Found">
                        <span class="item__number"> 6 </span>
                    </div>
                    <div class="item__row">
                        <h5 class="item__title">Работа со сканером штрих-кодов</h5>
                         <p class="item__subtitle">BBcrm поддерживает совместную работу  со сканером штрих-кодов, что упрощает поиск товара по базе программы и позволяет внедрение персональных дисконтных карт клиентов. <br><br> Большинство сканеров штрих-кодов работают без установки дополнительных программ.</p>
                    </div>
                </section>

                <section class="item">
                    <div class="item__left">
                        <img src="img/ability.png" alt="Not Found">
                        <span class="item__number"> 7 </span>
                    </div>
                    <div class="item__row">
                        <h5 class="item__title">Права доступа</h5>
                         <p class="item__subtitle">Детальная настройка прав доступа пользователя к функциям программы позволит вам создать удобный рабочий инструмент как для менеджеров по продажам, так и для администраторов. В программе есть возможность разграничения доступа как для групп пользователей, так и персонально для каждого сотрудника.</p>
                    </div>
                </section>

                <section class="item">
                    <div class="item__left">
                        <img src="img/ability.png" alt="Not Found">
                        <span class="item__number"> 8 </span>
                    </div>
                    <div class="item__row">
                        <h5 class="item__title">Удаленный доступ</h5>
                         <p class="item__subtitle">Программа работает в онлайн-режиме, что обеспечит удаленный круглосуточный доступ ко всем функциям и отчетам.</p>
                    </div>
                </section>
            </div>
        </div>

        <div class="banner-wrapper">
            <article class="banner">
                <div class="banner__info">
                    <div class="banner__img">
                        <img src="img/logo.png" title="Bbcrm" alt="Not Found">
                        <p>Программа <br> для автомагазинов</p>
                    </div>
                </div>
                <div class="banner__text">
                    <p>
                        Проверьте, подходит ли вам <span class="banner__span">BBcrm — получите 14 дней и помощь специалиста бесплатно</span>
                    </p>

                    <form action="Pages/SignUp/signup.php">
                        <button class="banner__button"><span>Получить бесплатно</span></button>
                    </form>

                </div>
            </article>
        </div>

        <div class="cost-wrapper">
            <div class="cost">
                <h2 class="cost__title">Стоимость внедрения BBcrm в ваш бизнес</h2>
                <p class="cost__subtitle first">Программа создана специально для автомагазинов, поэтому <span> не требует дополнительной платы </span> за внедрение и сложные настройки.</p>
                <p class="cost__subtitle"><span> После регистрации, вам необходимо пройти три простых шага:</span></p>
            </div>
        </div>
        <div class="cards-wrapper">
            <div class="cards">
                <section class="card">
                    <img src="img/cards/card-1.jpg" title="Создать магазин" alt="Not Found">
                    <h4>Создать магазин</h4>
                    <p>Название, адрес магазина и реквизиты банка, если есть.</p>
                </section>
                <section class="card">
                    <img src="img/cards/card-2.jpg" title="Заполнить склад" alt="Not Found">
                    <h4>Заполнить склад</h4>
                    <p>По артикулу товара, программа определит его название и производителя, вам останется только указать категорию и ввести закупочную цену.</p>
                </section>
                <section class="card">
                    <img src="img/cards/card-3.jpg" title="Добавить сотрудников" alt="Not Found">
                    <h4>Добавить сотрудников</h4>
                    <p>Здесь можете разграничить доступ к разделам и функциям системы для каждого сотрудника или подразделения, например, менеджеры или администрация.</p>
                </section>
            </div>
        </div>
        <div class="download-wrapper">
            <div class="wrapper">
                <article class="download">
                    <p class="download__text">Возможен импорт базы товаров из вашей программы в #bbcrm через xml или csv файл.</p>
                    <a class="download__link" href="">
                        <img src="img/download.png" title="Скачать сейчас" alt="Not Found">
                        <span>Скачать примеры <span class="download__link-decor">xml</span> и сvs</span>
                    </a>
                </article>
            </div>
        </div>

        <div class="signup-wrapper">
            <div class="signup">
                <h3>BBcrm готова к работе</h3>
                <p>Проверьте, подходит ли вам <span>BBcrm — получите 14 дней и помощь специалиста бесплатно</span></p>
                <button href="Pages/SignUp/signup.php"><span>РЕГИСТРАЦИЯ</span></button>

            </div>
        </div>

        <div class="safe-wrapper">
            <article class="wrapper">
                <div class="safe">
                    <h2 class="safe__title">Безопасность и конфиденциальность</h2>
                    <p class="safe__text">BBcrm система — это программа для магазинов автозапчастей, работающая в облачном режиме. Все ваши данные хранятся на веб-серверах, оснащенных <span>ультравысокой системой безопасности.</span> Ведется ежедневное резервное копирование на сторонний носитель компании Яндекс.</p>
    
                    <p class="safe__text">Так же установлен <span> SSL сертификат безопасности,</span> который подразумевает безопасную связь. Он использует асимметричную криптографию для аутентификации ключей обмена, симметричное шифрование для сохранения конфиденциальности, коды аутентификации сообщений для целостности сообщений.</p>
                </div>
            </article>
        </div>

        <div class="tariff-wrapper">
            <a id="tariff" ></a>
            <div class="tariff">
                <h2 class="tariff__text">Тарифы на пользование BBcrm системы</h2>

                <section class="tariff-card">
                    <h4 class="tariff-card__title">30 Дней</h4>
                    <div class="tariff-card__text">
                        <p>Без ограничений в количестве пользователей и функционале </p>
                        <p>Бесплатная информационная поддержка </p>
                        <p>Бесплатный тестовый период – 14 дней</p>
                    </div>
                    <div class="tariff-card__price-div">
                        <!-- <span class="tariff-card__sale"></span> -->
                        <p class="tariff-card__price">2 500 ₽</p>
                    </div>
                </section>

                <section class="tariff-card">
                    <h4 class="tariff-card__title">180 Дней</h4>
                    <div class="tariff-card__text">
                        <p>Без ограничений в количестве пользователей и функционале </p>
                        <p>Бесплатная информационная поддержка </p>
                        <p>Бесплатный тестовый период – 14 дней</p>
                    </div>
                    <div class="tariff-card__price-div">
                        <span class="tariff-card__sale">Экономия 600 Р</span>
                        <p class="tariff-card__price">14 440 ₽</p>
                    </div>
                </section>

                <section class="tariff-card">
                    <h4 class="tariff-card__title">360 Дней</h4>
                    <div class="tariff-card__text">
                        <p>Без ограничений в количестве пользователей и функционале </p>
                        <p>Бесплатная информационная поддержка </p>
                        <p>Бесплатный тестовый период – 14 дней</p>
                    </div>
                    <div class="tariff-card__price-div">
                        <span class="tariff-card__sale">Экономия 2 400</span>
                        <p class="tariff-card__price">27 760 ₽</p>
                    </div>
                </section>

            </div>
        </div>

        <footer class="footer-wrapper">
            <div class="wrapper">
                <div class="footer">
                    <div class="links">
                        <a href="#about"  title="Что такое BBcrm?" class="links__link">О ПРОГРАММЕ</a>
                        <a href="#ability" title="Восемь основных возможностей BBcrm" class="links__link">ВОЗМОЖНОСТИ</a>
                        <a href="#tariff" title="Тарифы на пользование BBcrm системы" class="links__link">ТАРИФЫ</a>
                    </div>
                    <div class="footer__about">
                        <a href="tel:88005002138" class="footer__data">8 800 500-21-38</a>
                        <a href="mailto:info@bbcrm.ru" class="footer__data">info@bbcrm.ru</a>
                        <img class="footer__img" src="img/footer_line.jpg" alt="Not Found">
                    </div>

                    <form class="footer__form" action="Pages/SignUp/signup.php">
                        <button class="footer__button"><span>РЕГИСТРАЦИЯ</span></button>
                    </form>

                    <!-- <div >
                        <span>РЕГИСТРАЦИЯ</span>
                    </div> -->
                    <p class="footer__text">Политика конфиденциальности и пользовательское соглашение</p>
                </div>
            </div>
        </article>
    </main>
    <script src="script.js"></script>
</body>
</html>