<?php
require_once 'connection.php';

session_start();


if (isset($_SESSION['user'])) {
    header('location: contacts.php');
}

if (isset($_REQUEST['register-btn'])) {

    // echo "<pre>";
    //     print_r($_REQUEST);
    // echo "</pre>";
    // $mysqli = new mysqli('localhost', 'root', ' ', 'users');
    // if ($mysqli->ping()) {
    //     printf ("Our connection is ok!\n"); 
    //   } else {
    //     printf ("Error: %s\n", $mysqli->error); 
    //   }

    $name = filter_var($_REQUEST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var(strtolower($_REQUEST['email']), FILTER_SANITIZE_EMAIL);
    $password = strip_tags($_REQUEST['password']);
    $password_verify = strip_tags($_REQUEST['password-verify']);

    if (empty($name)) {
        $errorMsg[0][] = 'Name erforderlich';
    }

    if (empty($email)) {
        $errorMsg[1][] = 'Email erforderlich';
    }

    if (empty($password)) {
        $errorMsg[2][] = 'Passwort erforderlich';
    }

    if (strlen($password) < 6) {
        $errorMsg[2][] = 'Muss mindestens 6 Zeichen lang sein';
    }

    if ($password_verify != $password) {
        $errorMsg[3][] = 'Passwörter sind anders';
    }
    
    if (empty($errorMsg)) {
        try {
            $select_stmt = $db->prepare("SELECT name, email FROM users WHERE email = :email");
            $select_stmt->execute([':email' => $email]);
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if (isset($row['email']) == $email) {
                $errorMsg[1][] = 'E-Mail ist bereits vorhanden';
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $created = new DateTime();
                $created = $created->format('Y-m-d H:i:s');
                $token = bin2hex(random_bytes(50));

                $insert_stmt = $db->prepare("INSERT INTO users (name, email, password, token, created) VALUES (:name,:email,:password,:token,:created)");

                if (
                    $insert_stmt->execute(
                        [
                            ':name' => $name,
                            'email' => $email,
                            ':password' => $hashed_password,
                            ':token' => $token,
                            ':created' => $created
                        ]
                    )
                ) {
                    header("location: login.php");
                }
            }
        } catch (PDOException $e) {
            $pdoError = $e->getMessage();
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
    <link rel="stylesheet" href="../styles/logon-register-forgot-form.css">
    <link rel="stylesheet" href="../styles/register.css">
    <link rel="stylesheet" href="../styles-additional/styles_header_footer-de.css">
    <title>Register</title>
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
                    <a href="../en/register.php">EN</a>
                    <a href="../ru/register.php">RU</a>
                </div>
            </div>

        </header>
        <main>
            <div class="popup-register" id="popup-register">
                <form action="register.php" method="POST">
                    <div class="form">
                        <h2>Registrieren</h2>
                        <div class="form-element">
                            <input type="text" id="name" name="name" placeholder="Name" class="form-field">
                            <label for="name" class="form-label">Name</label>
                            <?php
                            if (isset($errorMsg[0])) {
                                foreach ($errorMsg[0] as $nameErrors) {
                                    echo "<div class='error'>" . $nameErrors . "</div>";
                                }
                            }
                            ?>
                        </div>
                        <div class="form-element">
                            <input type="email" id="email" name="email" placeholder="Enter email" class="form-field">
                            <label for="email" class="form-label">Email</label>
                            <?php
                            if (isset($errorMsg[1])) {
                                foreach ($errorMsg[1] as $emailErrors) {
                                    echo "<div class='error'>" . $emailErrors . "</div>";
                                }
                            }
                            ?>
                        </div>
                        <div class="form-element">
                            <input type="password" id="password" name="password" placeholder="Enter password" class="form-field">
                            <label for="password" class="form-label">Passwort</label>
                            <?php
                            if (isset($errorMsg[2])) {
                                foreach ($errorMsg[2] as $passwordErrors) {
                                    echo "<div class='error'>" . $passwordErrors . "</div>";
                                }
                            }
                            ?>
                        </div>
                        <div class="form-element">
                            <input type="password" id="password" name="password-verify" placeholder="Enter password" class="form-field">
                            <label for="password" class="form-label">Passwort wiederholen</label>
                            <?php
                            if (isset($errorMsg[3])) {
                                foreach ($errorMsg[3] as $password2Errors) {
                                    echo "<div class='error'>" . $password2Errors . "</div>";
                                }
                            }
                            ?>
                        </div>
                        <div class="form-element">
                            <div class="button-wrapper">
                                <button type="submit" name="register-btn">Registrieren</button>
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
                        <a href="" id="caller1"><img src="../photos/sm-icos/3787324_vkontakte_brand_logo_social media_vk_icon.svg" alt="vk-logo"></a>
                        <a href="" id="caller2"><img src="../photos/sm-icos/5296515_bird_tweet_twitter_twitter logo_icon.svg" alt="twitte-logo"></a>
                        <a href="" id="caller3"><img src="../photos/sm-icos/771367_circle_facebook_logo_media_network_icon.svg" alt="facebook-logo"></a>
                    </div>
                    <div class="wrapper-links-second">
                        <a href="" id="caller4"><img src="../photos/sm-icos/3225191_app_instagram_logo_media_popular_icon.svg" alt="instagram-logo"></a>
                        <a href="" id="caller5"><img src="../photos/sm-icos/771370_circle_linkedin_logo_media_network_icon.svg" alt="linkedin-logo"></a>
                        <a href="" id="caller6"><img src="../photos/sm-icos/480px-HeadHunter_logo.png" alt="hh-logo"></a>
                    </div>
                </div>
                <div class="copyright">&copy; Eugene Mokrushin</div>
            </div>
        </footer>
    </div>
</body>

</html>