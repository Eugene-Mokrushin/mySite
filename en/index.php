<?php

require_once 'connection.php';
include '../authController.php';
include "logic.php";

// session_start();

if(isset($_GET['password-token'])) {
    $passwordToken = $_GET['password-token'];
    resetPassword($passwordToken);

}

function resetPassword($token)
{
    $conn_users = mysqli_connect("localhost:3306", " root", " ", "users"); 
    $sql_token = "SELECT * FROM users WHERE token = '$token' LIMIT 1";
    $result = mysqli_query($conn_users, $sql_token);
    $user = mysqli_fetch_assoc($result);
    $_SESSION['email_address'] = $user['email'];
    header('location: new_password.php');
    exit(0);
}


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
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="../scripts/script-particles.js"></script>
    <script src="../scripts/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="shortcut icon" type='x-icon' href="../photos/logo/capybara.svg">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/logon-register-forgot-form.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../styles/styles_header_footer.css">
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/attaches@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/warning@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/nested-list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Main</title>
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
                        <li class="menu-item-btn"><a href="index.php">Home</a></li>
                        <li class="menu-item-btn"><a href="about.php">About</a></li>
                        <li class="menu-item-btn"><a href="wip.php">WIP</a></li>
                        <li class="menu-item-btn"><a href="blog.php">Blog</a></li>
                        <li class="menu-item-btn"><a href="contacts.php">Contacts</a></li>
                    </ul>
                </div>
            </nav>
            <div class="banner">
                <a href="index.php">
                    <img src="../photos/logo/capybara.svg" alt="logo">
                </a>
            </div>
            <ul class="menu">
                <li class="menu-item"><a href="index.php">Home</a></li>
                <li class="menu-item"><a href="about.php">About</a></li>
                <li class="menu-item"><a href="wip.php">WIP</a></li>
                <li class="menu-item"><a href="blog.php">Blog</a></li>
                <li class="menu-item"><a href="contacts.php">Contacts</a></li>
            </ul>
            <div class="toggler-active" id="tga" style="display: none">
                <input type="checkbox" id="ios" class="ios"><label for="ios" class="ios button"></label>
                <div class="pointer"></div>
                <div class="main-bubble">
                    <div class="text">
                        This switch turns on/off particles outside of the page. Feel free to turn them off if the page
                        feels laggy!
                    </div>
                </div>
            </div>
            <div class="toggler-not-active" id="tgna" style="display: none">
                <input type="checkbox" id="ios-foo"><label for="ios-foo" class="ios-foo button-foo"></label>
                <div class="pointer-foo"></div>
                <div class="main-bubble-foo">
                    <div class="text-foo">
                        This switch turns on/off particles outside of the page. Feel free to turn them off if the page
                        feels laggy!
                    </div>
                </div>
            </div>
            <div class="sign-in">
                <?php
                if (isset($_SESSION['user'])) {
                    echo "<div class='authenticated'>" . $_SESSION['user']['name'] . "</div>";
                    echo "<div class='logout'><a href='logout.php'>Log out</a></div>";
                } else {
                    echo "<div class='log-in'> <a href='login.php'> Log in</a></div>";
                    echo "<div class='register'><a href='register.php'>Register</a></div>";
                }
                ?>
            </div>
            <div class="language-dropdown">
                <button class="dropbtn">EN</button>
                <div class="dropdown-content">
                    <a href="../ru/index.php">RU</a>
                    <a href="../de/index.php">DE</a>
                </div>
            </div>

        </header>

        <main>
            <div class="about-me">
                <div class="photo-box">
                    <img src="../photos/my_photos/IMG_8774.PNG" alt="main-photo" id="mf">
                    <img src="../photos/my_photos/IMG_8778.PNG" alt="white-layer" id="wl">
                    <img src="../photos/my_photos/IMG_8780.PNG" alt="purple-layer" id="pl">
                </div>
                <div class="text-descrption">
                    <div class="title">Hi! I am <span id="name_tag">Eugene.</span></div>
                    <div class="main-text" id="change-text">Why would I want to log in? To leave comments on my posts! (In the near future new features will be added, like generating family-tree or useful APIs. For registered users only!)
                    </div>
                    <div class="ticks-2"></div>
                </div>
            </div>
            <div class="blog">
                <div class="blog-title-main-wrapper">
                    <div class="blog-title-main">
                        <div class="blog-title">Blog.</div>
                        <div class="recent-posts">Recent posts.</div>
                    </div>
                </div>
                <div class="blog-content-warpper-wrapper">
                    <?php foreach ($query_last_two as $q_l_t) { ?>
                        <div class="blog-content-wrapper" id="second-block">

                            <div class="blog-content">
                                <article class="text-part">
                                    <div class="image-and-title">
                                        <div class="title"><a href="view.php?id=<?php echo $q_l_t['id']; ?>"><?php echo $q_l_t['title']; ?></a></div>
                                        <img src="../covers/<?php echo $q_l_t['covers']; ?>" alt="">
                                    </div>
                                    <div class="main-text">
                                    <?php echo $q_l_t['pre_en']; ?>
                                    </div>
                                    <div class="read-more-wrapper">
                                        <div class="read-more" id="second-article"><a href="view.php?id=<?php echo $q_l_t['id']; ?>">Read more</a></div>
                                    </div>
                                </article>
                            </div>

                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="gallery-wrapper">
                <div class="title-galery"><span class="title">Gallery.</span></div>
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="../photos/my_photos/DIFTfrZ56b4.jpg" alt="photo-slider"></div>
                        <div class="swiper-slide"><img src="../photos/my_photos/FbvKH71_2LA.jpg" alt="photo-slider"></div>
                        <div class="swiper-slide"><img src="../photos/my_photos/DVqFbFtGR2k.jpg" alt="photo-slider"></div>
                        <div class="swiper-slide"><img src="../photos/my_photos/adrE3YYDzY0.jpg" alt="photo-slider"></div>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                </div>
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
        if (window.screen.width >= 1024) {
            var text = ["This piece of site is not without bugs! Please let me know if you find any... ", "How did you stumble on this website? Are you recruiter, friend or stalker? &#129320; \nHope not all at once...", "Why would I want to log in? To leave comments on my posts! (In the near future new features will be added, like generating family-tree or useful APIs. For registered users only!)"];
            var counter = 0;
            var elem = $("#change-text");;
            setInterval(change, 9000);

            function change() {
                elem.fadeOut(function() {
                    elem.html(text[counter]);
                    counter++;
                    if (counter >= text.length) {
                        counter = 0;
                    }
                    elem.fadeIn();
                });
            }
        }
    </script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            loop: true,

            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

        });
    </script>
</body>

</html>