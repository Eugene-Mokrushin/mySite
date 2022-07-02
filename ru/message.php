<?php
require_once 'connection.php';

session_start();
include "logic.php";

if (isset($_SESSION['user'])) {
    header("location: index.php");
}

if (isset($_REQUEST['home_btn'])) {

    header("location: index.php");
}

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="../scripts/script-particles.js"></script>
    <link rel="shortcut icon" type='x-icon' href="../photos/logo/capybara.svg">
    <link rel="stylesheet" href="../styles-additional/styles_header_footer-ru.css">
    <link rel="stylesheet" href="../styles/logon-register-forgot-form.css">
    <link rel="stylesheet" href="../styles/forgot.css">
    <title>Password sent</title>
</head>

<body>
    <div id="particles-js"></div>
    <div class="container">
        <header class="header">
            <nav role="navigation">
                <div id="menuToggle">
                    <input type="checkbox" />
                    <span></span>
                    <span></span>
                    <span></span>
                    <ul id="menu" style="text-align:left !important;">
                        <li class="menu-item-btn"><a href="index.php">Главная</a></li>
                        <li class="menu-item-btn"><a href="about.php">О&nbsp;себе</a></li>
                        <li class="menu-item-btn"><a href="wip.php">В&nbsp;работе</a></li>
                        <li class="menu-item-btn"><a href="blog.php">Блог</a></li>
                        <li class="menu-item-btn"><a href="contacts.php">Контакты</a></li>
                    </ul>
                </div>
            </nav>
            <div class="banner">
                <a href="index.php">
                    <img src="../photos/logo/capybara.svg" alt="logo">
                </a>
            </div>
            <ul class="menu">
                <li class="menu-item"><a href="index.php">Главная</a></li>
                <li class="menu-item"><a href="about.php">О&nbsp;себе</a></li>
                <li class="menu-item"><a href="wip.php">В&nbsp;работе</a></li>
                <li class="menu-item"><a href="blog.php">Блог</a></li>
                <li class="menu-item"><a href="contacts.php">Контакты</a></li>
            </ul>
            <div class="toggler-active" id="tga" style="display: none">
                <input type="checkbox" id="ios" class="ios"><label for="ios" class="ios button"></label>
                <div class="pointer"></div>
                <div class="main-bubble">
                    <div class="text">
                        Этот переключатель включает/выключает эффекты за пределами страницы. Выключите их, если страница тормозит!
                    </div>
                </div>
            </div>
            <div class="toggler-not-active" id="tgna" style="display: none">
                <input type="checkbox" id="ios-foo"><label for="ios-foo" class="ios-foo button-foo"></label>
                <div class="pointer-foo"></div>
                <div class="main-bubble-foo">
                    <div class="text-foo">
                        Этот переключатель включает/выключает эффекты за пределами страницы. Выключите их, если страница тормозит!
                    </div>
                </div>
            </div>
            <div class="sign-in">
                <?php
                if (isset($_SESSION['user'])) {
                    echo "<div class='authenticated'>" . $_SESSION['user']['name'] . "</div>";
                    echo "<div class='logout'><a href='logout.php'>Выйти</a></div>";
                } else {
                    echo "<div class='log-in'> <a href='login.php'>Войти</a></div>";
                    echo "<div class='register' style='height: initial !important;'><a href='register.php'>Зарегистрироваться</a></div>";
                }
                ?>
            </div>
            <div class="language-dropdown">
                <button class="dropbtn">RU</button>
                <div class="dropdown-content">
                    <a href="../en/message.php">EN</a>
                    <a href="../de/message.php">DE</a>
                </div>
            </div>

        </header>
        <main>
            <div class="popup" id="popup">
                <form action="message.php" method="POST">
                    <div class="form">
                        <div class="text-recover" style="width: initial !important;">
                            Ссылка на востановление пароля была отправлена на ваш email.
                        </div>
                        <div class="form-element">
                            <div class="button-wrapper">
                                <button type="submit" name="home_btn">Главная</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        <footer>
            <div class="footer-wrapper">
                <div class="social-media-logos">
                    <div class="wrapper-links-first">
                        <a href="https://vk.com/bipki_knower" target="_blank" id="caller1"><img src="../photos/sm-icos/3787324_vkontakte_brand_logo_social media_vk_icon.svg" alt="vk-logo"></a>
                        <a href="https://www.theguardian.com/world/2022/mar/04/russia-completely-blocks-access-to-facebook-and-twitter" id="caller2" target="_blank"><img src="../photos/sm-icos/5296515_bird_tweet_twitter_twitter logo_icon.svg" alt="twitte-logo"></a>
                        <a href="https://www.theguardian.com/world/2022/mar/04/russia-completely-blocks-access-to-facebook-and-twitter" id="caller3" target="_blank"><img src="../photos/sm-icos/771367_circle_facebook_logo_media_network_icon.svg" alt="facebook-logo"></a>
                    </div>
                    <div class="wrapper-links-second">
                        <a href="https://www.instagram.com/gogokiiro/" target="_blank" id="caller4"><img src="../photos/sm-icos/3225191_app_instagram_logo_media_popular_icon.svg" alt="instagram-logo"></a>
                        <a href="https://www.linkedin.com/in/evgeniy-mokrushin-4b49a11a4/" target="_blank" id="caller5"><img src="../photos/sm-icos/771370_circle_linkedin_logo_media_network_icon.svg" alt="linkedin-logo"></a>
                        <a href="https://hh.ru/resume/f2375561ff063c509a0039ed1f4a34496f7141" target="_blank" id="caller6"><img src="../photos/sm-icos/480px-HeadHunter_logo.png" alt="hh-logo"></a>
                    </div>
                </div>
                <div class="copyright">&copy; Eugene Mokrushin</div>
            </div>
        </footer>
    </div>
</body>

</html>