<?php

require_once 'connection.php';

session_start();
if (((isset($_SESSION['user'])) == false) and (isset($_COOKIE['guid']))) {
    print_r('i am here');
    $guid_w = $_COOKIE['guid'];
    $conn_users = mysqli_connect("localhost:3306", " root", " ", "users");
    $select_stmt = $db->prepare("SELECT * FROM users WHERE guid_w = :guid_w LIMIT 1");
    $select_stmt->execute([
        ':guid_w' => $guid_w
    ]);
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    if ($select_stmt->rowCount() > 0) {

        $_SESSION['user']['name'] = $row["name"];
        $_SESSION['user']['email'] = $row["email"];
        $_SESSION['user']['id'] = $row["id"];
    }
    header("location: index.php");
    exit();
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles-additional/styles_header_footer-ru.css">
    <link rel="stylesheet" href="../styles/logon-register-forgot-form.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="shortcut icon" type='x-icon' href="../photos/logo/capybara.svg">
    <link rel="stylesheet" href="../styles-additional/styles-contacts-ru.css">
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="../scripts/script-particles.js"></script>
    <title>Contacts</title>
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
                    echo "<div class='register'><a href='register.php'>Зарегистрироваться</a></div>";
                }
                ?>
            </div>
            <div class="language-dropdown">
                <button class="dropbtn">RU</button>
                <div class="dropdown-content">
                    <a href="../en/contacts.php">EN</a>
                    <a href="../de/contacts.php">DE</a>
                </div>
            </div>

        </header>

        <main>
            <div class="email-box">
                <div class="email-click">
                    <div class="email-copy-wrapper">
                        <input type="text" class="email" value="eugeniymokrushin@gmail.com" id="email">
                        <img src="../photos/icos/2849804_copy_document_paper_file_multimedia_icon.svg" alt="copy" onclick="copyEmail()">
                    </div>
                    <div class="fixer" id="fixer">
                        <div class="bubble">Скопированно!</div>
                        <div class="pointer"></div>
                    </div>

                </div>
                <div class="simple">сделаем это проще</div>
                <div class="tg">
                    (Телеграм тоже вариант - <a href="https://t.me/ZheRoNA" target="_blank">@ZheRoNA</a>)
                </div>
            </div>
            <div class="can-find">
                <div class="title-map">
                    <div class="find-text">Также вы можете найти меня здесь на данный момент</div><img src="../photos/icos/1654366_arrow_clockwise_swirl_tornado_twister_icon.svg" alt="arrow">
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d481981.1935802329!2d37.147759222372954!3d55.58193062697205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54afc73d4b0c9%3A0x3d44d6cc5757cf4c!2sMoscow!5e0!3m2!1sen!2sru!4v1656507627205!5m2!1sen!2sru" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
    <script>
        var input = document.querySelector('input[type="text"]');

        input.addEventListener("keydown", function() {
            var oldVal = this.value;
            console.log(oldVal);
            var field = this;
            console.log("funciona");

            setTimeout(function() {
                if (field.value.indexOf('eugeniymokrushin@gmail.com') !== 0) {
                    field.value = oldVal;
                }
            }, 1);
        });
    </script>
    <script>
        function copyEmail() {
            var copyText = document.getElementById("email");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            var bubble = document.getElementById("fixer");
            bubble.style.display = 'inline';
            copyText.style.backgroundColor = '#39279a';

        }
    </script>
    <script>
        function hideDiv() {
            document.getElementById('popup').style.display = "none";
        }

        function showDiv() {
            document.getElementById('popup').style.display = "block";
            document.getElementById('popup-register').style.display = "none";
        }

        function hideDivRegister() {
            document.getElementById('popup-register').style.display = "none";

        }

        function showDivRegister() {
            document.getElementById('popup-register').style.display = "block";
            document.getElementById('popup').style.display = "none";

        }
    </script>
</body>

</html>