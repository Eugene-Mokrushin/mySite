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

include "logic.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styles-wip.css">
    <link rel="stylesheet" href="../styles-additional/styles_header_footer-de.css">
    <link rel="stylesheet" href="../styles/logon-register-forgot-form.css">
    <link rel="shortcut icon" type='x-icon' href="../photos/logo/capybara.svg">
    <script src="../scripts/script-particles.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <title>WIP</title>
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
                    <a href="../en/wip.php">EN</a>
                    <a href="../ru/wip.php">RU</a>
                </div>
            </div>

        </header>

        <main>
            <div class="current-project-title">
                <span>Derzeitiges Projekt</span>
                <?php if (isset($_SESSION['user']) and $_SESSION['user']['email'] == ' ') { ?>
                    <button class="new-project" onclick="newProject()" id="newProjectButton">New project</button>
                    <form method="POST">
                        <input type="text" name="progress-done">
                        <button name="save-progress">Save progress</button>
                    </form>
                <?php } ?>
            </div>
            <div class="current-prodject-wrapper">
                <?php if (isset($_SESSION['user']) and $_SESSION['user']['email'] == ' ') { ?>
                    <div class="new-project-wrapper" style="display: none;" id="new-project-start">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="photo-drag">
                                <div class="drop-zone" id="backgroung">
                                    <span class="drop-zone__prompt"> Drop image cover here or click to upload</span>
                                    <input type="file" name="cover" class="drop-zone__input">
                                </div>
                            </div>
                            <div class="text-wrapper">
                                <div class="en-block" style="display: none;" id="en-block">
                                    <input type="text" placeholder="Blog Title En" name="title-en" class="new-project-title">
                                    <textarea type="text" placeholder="Main text En" name="text-en" id="main-text"></textarea>
                                    <p onclick="goToRu()">Go to ru</p>
                                </div>
                                <div class="ru-block" style="display: none;" id="ru-block">
                                    <input type="text" placeholder="Blog Title Ru" name="title-ru" class="new-project-title">
                                    <textarea type="text" placeholder="Main text Ru" name="text-ru" id="main-text"></textarea>
                                    <p onclick="goToDe()">Go to de</p>
                                </div>
                                <div class="de-block" style="display: none;" id="de-block">
                                    <input type="text" placeholder="Blog Title De" name="title-de" class="new-project-title">
                                    <textarea type="text" placeholder="Main text De" name="text-de" id="main-text"></textarea>
                                    <button class="create-btn" name="new_project-de" id="save-all">Add new project</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php } ?>
                <?php foreach ($query_wip_projects_first as $q_w_p_f) { ?>
                    <div class="picture" id="old-project-picture">
                        <img src="../projectsCovers/<?php echo $q_w_p_f['photo'] ?>" alt="projec-cover">
                    </div>
                    <div class="text-part" id="old-project-text">
                        <div class="title"><?php echo $q_w_p_f['title_de'] ?></div>
                        <div class="main-descriptions"><?php echo $q_w_p_f['description_de'] ?></div>
                    </div>
                <?php } ?>
            </div>
            <div class="bar-wrapper" id="page-wrap">
                <div class="meter animate">
                    <?php foreach ($query_wip_progress as $q_w_p) { ?>
                        <span style="width: <?php echo $q_w_p['state']; ?>%" id="collar"><span></span></span>
                    <?php } ?>
                </div>
            </div>
            <div class="past-project-title">
                <div class="past-project-title-main">
                    <span>Vergangene Projekte</span>
                </div>
            </div>
            <div class="past-projects-wrapper">
                <?php foreach ($query_wip_projects as $q_w_projects) { ?>
                    <div class="past-project">
                        <div class="tree" style="width: initial;">
                            <div class="main-sqare">
                                <div class="square-cover"></div>
                            </div>
                            <div class="bottom-main-sqare">
                                <div class="bottom-square-cover"></div>
                            </div>
                        </div>
                        <img src="../projectsCovers/<?php echo $q_w_projects['photo'] ?>" alt="past-project-cover">
                        <div class="text-wrapper">
                            <div class="title-past-project"><?php echo $q_w_projects['title_de'] ?></div>
                            <div class="small-description"><?php echo $q_w_projects['description_de'] ?></div>
                        </div>
                    </div>
                <?php } ?>
                <div class="past-project">
                    <div class="end-tree" style="width: initial;">
                        <div class="main-sqare" id="last-in-list">
                            <div class="square-cover"></div>
                        </div>
                    </div>
                    <img src="../photos/wip-covers/1_wip.png" alt="past-projec-cover">
                    <div class="text-wrapper">
                        <div class="title-past-project">Entwicklung einer persönlichen Website
                        </div>
                        <div class="small-description">Um den visuellen Überblick für Leute zu behalten, die mit Git nicht vertraut sind, wollte ich schon immer meine eigene Website erstellen. Es wird auch helfen, besondere Dinge für meine Bekannten zu schaffen.</div>
                    </div>
                </div>
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
        <script>
            function goToDe() {
                let newProjectRu = document.getElementById('ru-block');
                newProjectRu.style.display = 'none';
                let newProjectDe = document.getElementById('de-block');
                newProjectDe.style.display = 'initial';
            }
        </script>
        <script>
            function goToRu() {
                let newProjectEn = document.getElementById('en-block');
                newProjectEn.style.display = 'none';
                let newProjectRu = document.getElementById('ru-block');
                newProjectRu.style.display = 'initial';
            }
        </script>
        <script>
            function newProject() {
                let oldProject = document.getElementById('old-project-picture');
                oldProject.style.display = 'none';
                oldProject = document.getElementById('old-project-text');
                oldProject.style.display = 'none';
                let newProjectStart = document.getElementById('new-project-start');
                newProjectStart.style.display = 'initial';
                let newProjectEn = document.getElementById('en-block');
                newProjectEn.style.display = 'initial';
                let newProjectButton = document.getElementById('newProjectButton');
                newProjectButton.style.display = 'none';
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
    </div>
    <script src="../scripts/create.js"></script>
</body>

</html>