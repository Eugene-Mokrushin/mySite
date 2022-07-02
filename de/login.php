<?php
require_once 'connection.php';

session_start();
include "logic.php";

if (isset($_SESSION['user'])) {
    header("location: index.php");
}

if (isset($_REQUEST['login_btn'])) {
    $email = filter_var(strtolower($_REQUEST['email']), FILTER_SANITIZE_EMAIL);
    $password = strip_tags($_REQUEST['password']);
    $chekbox = $_REQUEST['remember'];

    if (empty($email)) {
        $errorMsgLogIn[0][] = 'Email eingeben';
    } else if (empty($password)) {
        $errorMsgLogIn[1][] = 'Passwort eingeben';
    } else {
        try {
            $select_stmt = $db->prepare("SELECT * from users WHERE email = :email LIMIT 1");
            $select_stmt->execute([
                ':email' => $email
            ]);
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if ($select_stmt->rowCount() > 0) {
                if (password_verify($password, $row["password"])) {

                    $_SESSION['user']['name'] = $row["name"];
                    $_SESSION['user']['email'] = $row["email"];
                    $_SESSION['user']['id'] = $row["id"];
                    if ($chekbox == 'on') {
                        $id = $row['id'];
                        $random_base64 = base64_encode(random_bytes(18));
                        setcookie('guid', $random_base64, time() + 60 * 60 * 7 * 4 * 12, '/');
                        $sql_add_guid = ("UPDATE users SET guid_w = '$random_base64' WHERE id = $id");
                        $conn_add_guid = mysqli_connect("localhost:3306", " root", " ", "users");
                        mysqli_query($conn_add_guid, $sql_add_guid);
                    }
                    header("location: index.php");
                    exit();
                } else {
                    $errorMsgLogIn[3][] = 'Falsche Anmeldeinformationen';
                }
            } else {
                $errorMsgLogIn[3][] = 'Falsche Anmeldeinformationen';
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
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
    <link rel="stylesheet" href="../styles-additional/styles_header_footer-de.css">
    <link rel="stylesheet" href="../styles/logon-register-forgot-form.css">
    <link rel="stylesheet" href="../styles/login.css">
    <title>Log In</title>
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
                    <ul id="menu">
                        <li class="menu-item-btn"><a href="index.php">Heim</a></li>
                        <li class="menu-item-btn"><a href="about.php">Über&nbsp;Mich</a></li>
                        <li class="menu-item-btn"><a href="wip.php">In&nbsp;Arbeit</a></li>
                        <li class="menu-item-btn"><a href="blog.php">Bloggen</a></li>
                        <li class="menu-item-btn"><a href="contacts.php">Kontakte</a></li>
                    </ul>
                </div>
            </nav>
            <div class="banner">
                <a href="index.php">
                    <img src="../photos/logo/capybara.svg" alt="logo">
                </a>
            </div>
            <ul class="menu">
                <li class="menu-item"><a href="index.php">Heim</a></li>
                <li class="menu-item"><a href="about.php">Über&nbsp;Mich</a></li>
                <li class="menu-item"><a href="wip.php">In&nbsp;Arbeit</a></li>
                <li class="menu-item"><a href="blog.php">Bloggen</a></li>
                <li class="menu-item"><a href="contacts.php">Kontakte</a></li>
            </ul>
            <div class="toggler-active" id="tga" style="display: none">
                <input type="checkbox" id="ios" class="ios"><label for="ios" class="ios button"></label>
                <div class="pointer"></div>
                <div class="main-bubble">
                    <div class="text">
                        Dieser Schalter schaltet Partikel außerhalb der Seite ein/aus. Fühlen Sie sich frei, sie auszuschalten, wenn sich die Seite verzögert anfühlt!
                    </div>
                </div>
            </div>
            <div class="toggler-not-active" id="tgna" style="display: none">
                <input type="checkbox" id="ios-foo"><label for="ios-foo" class="ios-foo button-foo"></label>
                <div class="pointer-foo"></div>
                <div class="main-bubble-foo">
                    <div class="text-foo">
                        Dieser Schalter schaltet Partikel außerhalb der Seite ein/aus. Fühlen Sie sich frei, sie auszuschalten, wenn sich die Seite verzögert anfühlt!
                    </div>
                </div>
            </div>
            <div class="sign-in">
                <?php
                if (isset($_SESSION['user'])) {
                    echo "<div class='authenticated'>" . $_SESSION['user']['name'] . "</div>";
                    echo "<div class='logout'><a href='logout.php'>Ausloggen</a></div>";
                } else {
                    echo "<div class='log-in'> <a href='login.php'>Einloggen</a></div>";
                    echo "<div class='register' style='height: initial !important'><a href='register.php'>Registrieren</a></div>";
                }
                ?>
            </div>
            <div class="language-dropdown">
                <button class="dropbtn">DE</button>
                <div class="dropdown-content">
                    <a href="../en/login.php">EN</a>
                    <a href="../ru/login.php">RU</a>
                </div>
            </div>

        </header>
        <main>
            <div class="popup" id="popup">
                <form action="login.php" method="POST">
                    <div class="form">
                        <h2>Einloggen</h2>
                        <div class="form-element">
                            <input type="email" id="email" name="email" placeholder="Enter email" class="form-field">
                            <label for="email" class="form-label">Email</label>
                            <?php
                            if (isset($errorMsgLogIn[0])) {
                                foreach ($errorMsgLogIn[0] as $nameErrors) {
                                    echo "<div class='error'>" . $nameErrors . "</div>";
                                }
                            }
                            ?>
                        </div>
                        <div class="form-element">
                            <input type="password" id="password" name="password" placeholder="Enter password" class="form-field">
                            <label for="password" class="form-label">Passwort</label>
                            <?php
                            if (isset($errorMsgLogIn[1])) {
                                foreach ($errorMsgLogIn[1] as $nameErrors) {
                                    echo "<div class='error'>" . $nameErrors . "</div>";
                                }
                            }
                            ?>
                        </div>
                        <div class="form-element">
                            <div class="remember-me-wrapper">
                                <label for="remember-me" id="override-remember">Erinnere dich an mich
                                    <input type="checkbox" id="remember-me" name="remember" checked>
                                    <span class="checkmark">
                                    </span>
                                </label>
                            </div>
                        </div>
                        <?php
                        if (isset($errorMsgLogIn[3])) {
                            foreach ($errorMsgLogIn[3] as $nameErrors) {
                                echo "<div class='error'>" . $nameErrors . "</div>";
                            }
                        }
                        ?>
                        <div class="form-element">
                            <div class="button-wrapper">
                                <button type="submit" name="login_btn">Einloggen</button>
                            </div>
                        </div>
                        <div class="form-element">
                            <div class="forgot-password-wrapper">
                                <a href="forgot.php">Passwort vergessen?</a>
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