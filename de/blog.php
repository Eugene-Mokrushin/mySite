<?php

require_once 'connection.php';
include "logic.php";

session_start();

if (((isset($_SESSION['user'])) == false) and (isset($_COOKIE['guid']))) {
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
<?php

include "logic.php";

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../scripts/script-particles.js"></script>
    <link rel="shortcut icon" type='x-icon' href="../photos/logo/capybara.svg">
    <link rel="stylesheet" href="../styles/logon-register-forgot-form.css">
    <link rel="stylesheet" href="../styles-additional/styles_header_footer-de.css">
    <link rel="stylesheet" href="../styles-additional/blog-de.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <title>Blog</title>
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
                    echo "<div class='register'><a href='register.php'>Registrieren</a></div>";
                }
                ?>
            </div>
            <div class="language-dropdown">
                <button class="dropbtn">DE</button>
                <div class="dropdown-content">
                    <a href="../en/blog.php">EN</a>
                    <a href="../ru/blog.php">RU</a>
                </div>
            </div>

        </header>
        <main>
            <div class="title-wrapper">
                <div class="title">
                    <span id="time">Wie spät ist es?</span>
                    <span id="name_tag">BLOGZEIT!</span>
                </div>
                <div class="content">
                    <div class="content__container">
                        <p class="content__container__text">
                            Ich poste über
                        </p>

                        <ul class="content__container__list">
                            <li class="content__container__list__item">Kodierung !</li>
                            <li class="content__container__list__item">Reisen !</li>
                            <li class="content__container__list__item">Entspannen !</li>
                            <li class="content__container__list__item">Alles !</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="blog-wrapper-create-added">
                <?php
                if (isset($_SESSION['user']) and $_SESSION['user']['email'] == ' ') {
                    echo "<div class='add-post'> <a href='create.php' class='create-new-post'>+ Create new post</a></div>";
                }
                ?>
                <?php
                if (isset($_REQUEST['info'])) { ?>
                    <?php if ($_REQUEST['info'] == 'added') { ?>
                        <div class="post-has-been-added" role="alert">
                            Post has been added successfully!
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="blog-posts-wrapper">
                <div class="blog-posts">
                    <?php foreach ($query as $q) { ?>

                        <a href='view.php?id=<?php echo $q['id']; ?>' style="background-image: url(../covers/<?php echo $q['covers']; ?>); background-size: cover; background-position: center center;" class="link">
                            <div class="drop-shadow">
                                <div class="glass">
                                    <div class="title"><?php echo $q['title']; ?></div>
                                </div>
                            </div>
                        </a>

                    <?php } ?>
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
        function loop($swap) {
            var next = $swap.find("li.visible").removeClass("visible").index() + 1;

            if (next >= $swap.find("li").length) {
                next = 0;
            }

            $swap.width($($swap.find("li").get(next)).addClass("visible").outerWidth());
            $swap.css({
                "transform": "translateY(-" + next * 3.2 + "rem)"
            });

            setTimeout(function() {
                loop($swap);
            }, 2000);
        };

        $(function() {
            $(".swap").each(function() {
                var $this = $(this);

                $this.find("li").each(function() {
                    $(this).css({
                        top: $(this).index() * 3.1 + "rem"
                    });
                });

                loop($this);
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script>
        let bodyHeight = document.querySelector('body').offsetHeight;
        let canvasNewHeight = document.getElementById('particles-js')
        canvasNewHeight.style.height = bodyHeight;
    </script>
</body>

</html>