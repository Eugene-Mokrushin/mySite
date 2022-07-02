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
    <link rel="shortcut icon" type='x-icon' href="../photos/logo/capybara.svg">
    <link rel="stylesheet" href="../styles/styles_about.css">
    <link rel="stylesheet" href="../styles-additional/styles_header_footer-de.css">
    <link rel="stylesheet" href="../styles/styles_header_footer.css">
    <script src="../scripts/script-particles.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/TagCloud@2.2.0/dist/TagCloud.min.js"></script>
    <title>About</title>
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
                    <a href="../en/about.php">EN</a>
                    <a href="../ru/about.php">RU</a>
                </div>
            </div>

        </header>
        <main>
            <div class="text-wrapper">
                <div class="text-scramble"></div>
            </div>
            <div class="my-description">
                <div class="photo"><img src="../photos/my_photos/JQLaLfqMjT4.jpg" alt="me"></div>
                <div class="description">
                    <div class="title">Wer bin ich?</div>
                    <div class="main-text">
                        Wie Sie wahrscheinlich bereits wissen, heiße ich Eugene. Ich bin erst 20 Jahre alt und strebe danach, Software-Ingenieur zu werden. Mein beruflicher Weg, aber auch meine Bildungsbemühungen verliefen nicht ohne Fehler und Probleme. Zum Beispiel versuchte ich während meiner Oberschulzeit, mich am MIT zu bewerben, obwohl ich, wie sich herausstellte, versuchte, mehr zu beißen, als ich kauen konnte. Obwohl meine SAT-Ergebnisse ziemlich anständig waren, war ich mit einer mittelmäßigen Universität nicht zufrieden, also verfolgte ich meine Karriere und meinen Bildungsweg in Russland weiter.
                        <br><br>
                        Ich bin derzeit an der RANEPA-Universität im Hauptfach Management eingeschrieben. Man könnte denken – wie korrelieren Codierung und Management? Meine damalige Logik war einfach. Ich werde als Manager für den Bachelor studieren, da ich im Management von Zeit, Menschen und Ressourcen im Grunde ein Neuling war. Ich verstand, dass dies mein schwächstes Glied war. Wie schon während meiner Schulzeit habe ich versucht, mich auf Fächer zu konzentrieren, die mir schwergefallen sind - deshalb bin ich in die Sprachklasse gegangen und studiere jetzt im Bereich Management.
                        <br><br>
                        Was in meiner Zukunft steht: Ich plane zu wechseln und einen Master of Science, Major Software Engeneer, zu machen. Das wird mir helfen, das Beste aus beiden Welten zu bekommen – BBA für das Managen von Teams, MS dafür, dass ich in meinem Hauptjob gut bin.
                        <br><br>
                        Was meine Berufserfahrung anbelangt, so war ich während der Abschlussjahre hin und wieder als Schriftsetzer tätig. Jetzt arbeite ich seit zwei Jahren in Folge als E-Commerce-Spezialist - ich helfe beim Einrichten von APIs, schreibe einfache Skripte, um die Arbeitszeit meiner Kollegen zu erleichtern, und verwalte den nativen Marktplatz meines Unternehmens.
                    </div>
                </div>
            </div>

            <div class="skills-text">
                <div class="skills-title-main">
                    <span>Fähigkeiten.</span>
                </div>
            </div>
            <div class="globe-skills-wrapper"><span class="bubble-skills"></span></div>

            <div class="history"><span>Kurze Geschichte.</span></div>
            <div class="my-life-path">
                <div class="life-point-wrapper">
                    <div class="life-points" id="fst-history">
                        <div class="text">
                            <div class="company-title">GB Kurse</div>
                            <div class="job-title">Webdev</div>
                        </div>
                        <div class="years-of-exp">
                            <div class="years">16-17</div>
                        </div>
                    </div>
                </div>
                <div class="life-point-wrapper">
                    <div class="life-points" id="scnd-history">
                        <div class="text">
                            <div class="company-title">RANEPA Uni</div>
                            <div class="job-title">BBA</div>
                        </div>
                        <div class="years-of-exp">
                            <div class="years">19-22</div>
                        </div>
                    </div>
                </div>
                <div class="life-point-wrapper">
                    <div class="life-points" id="thrd-history">
                        <div class="text">
                            <div class="company-title">MAY Inc.</div>
                            <div class="job-title">Ecom-Spezialist</div>
                        </div>
                        <div class="years-of-exp">
                            <div class="years">20-22</div>
                        </div>
                    </div>
                </div>
                <div class="life-point-wrapper">
                    <div class=" life-points" id="frth-history">
                        <div class="text">
                            <div class="company-title">ABS Paris</div>
                            <div class="job-title">BBA</div>
                        </div>
                        <div class="years-of-exp">
                            <div class="years">22 ~</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="currently-reading-wrapper">
                <div class="reading-title-main-wrapper">
                    <div class="reading-title-main">
                        <div class="reading-title">Lese gerade.</div>
                    </div>
                </div>
                <div class="image-wrapper">
                    <div class="content">
                        <img src="../photos/book-covres/41yWEoS-nDL.jpg" alt="steppen-wolf">
                        <div class="title">Steppenwolf</div>
                        <div class="author">Hermann Hesse</div>
                    </div>
                    <div class="content">
                        <img src="../photos/book-covres/CCAE2FBD-ADE2-4D06-8D7B-6B8C4E6FE894.jpg" alt="animal-farm">
                        <div class="title">Tierfarm</div>
                        <div class="author">George Orwell</div>
                    </div>
                    <div class="content">
                        <img src="../photos/book-covres/make_nimage.jpg" alt="homo-deus">
                        <div class="title">Homo Deus</div>
                        <div class="author">Yuval Noah Harari</div>
                    </div>
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
        class TextScramble {
            constructor(el) {
                this.el = el;
                this.chars = '!<>-_\\/[]{}—=+*^?#________';
                this.update = this.update.bind(this);
            }

            setText(newText) {
                const oldText = this.el.innerText;
                const length = Math.max(oldText.length, newText.length);
                const promise = new Promise(resolve => this.resolve = resolve);
                this.queue = [];

                for (let i = 0; i < length; i++) {
                    const from = oldText[i] || '';
                    const to = newText[i] || '';
                    const start = Math.floor(Math.random() * 40);
                    const end = start + Math.floor(Math.random() * 40);
                    this.queue.push({
                        from,
                        to,
                        start,
                        end
                    });
                }

                cancelAnimationFrame(this.frameRequest);
                this.frame = 0;
                this.update();
                return promise;
            }

            update() {
                let output = '';
                let complete = 0;

                for (let i = 0, n = this.queue.length; i < n; i++) {
                    let {
                        from,
                        to,
                        start,
                        end,
                        char
                    } = this.queue[i];

                    if (this.frame >= end) {
                        complete++;
                        output += to;
                    } else if (this.frame >= start) {
                        if (!char || Math.random() < 0.28) {
                            char = this.randomChar();
                            this.queue[i].char = char;
                        }

                        output += `<span class="dud">${char}</span>`;
                    } else {
                        output += from;
                    }
                }

                this.el.innerHTML = output;

                if (complete === this.queue.length) {
                    this.resolve();
                } else {
                    this.frameRequest = requestAnimationFrame(this.update);
                    this.frame++;
                }
            }

            randomChar() {
                return this.chars[Math.floor(Math.random() * this.chars.length)];
            }

        }
        const phrases = ['Ideen', 'erändern die Welt nur', 'wenn sie das Verhalten verändern.'];
        const el = document.querySelector('.text-scramble');
        const fx = new TextScramble(el);
        let counter = 0;

        const next = () => {
            fx.setText(phrases[counter]).then(() => {
                setTimeout(next, 1000);
            });
            counter = (counter + 1) % phrases.length;
        };

        next();
    </script>
    <script>
        var viewport_width = window.innerWidth;

        const myTags = [
            'JavaScript', 'CSS3', 'HTML5',
            'TypeScript', 'C++', 'ReactJS',
            'Python3', 'PHP8', 'git',
            'django', 'Node.js', 'Laravel',
            'AngularJS', 'MySQL', 'jQuery',
        ];
        if (viewport_width >= 300 && viewport_width < 630) {
            var tagCloud = TagCloud('.bubble-skills', myTags, {

                // radius in px
                radius: 150,

                // animation speed
                // slow, normal, fast
                maxSpeed: 'fast',
                initSpeed: 'fast',

                // 0 = top
                // 90 = left
                // 135 = right-bottom
                direction: 135,

                // interact with cursor move on mouse out
                keep: true

            });
        } else if (viewport_width >= 630 && viewport_width < 1024) {
            var tagCloud = TagCloud('.bubble-skills', myTags, {

                // radius in px
                radius: 300,

                // animation speed
                // slow, normal, fast
                maxSpeed: 'fast',
                initSpeed: 'fast',

                // 0 = top
                // 90 = left
                // 135 = right-bottom
                direction: 135,

                // interact with cursor move on mouse out
                keep: true

            });
        } else if (viewport_width >= 1024) {
            var tagCloud = TagCloud('.bubble-skills', myTags, {

                // radius in px
                radius: 300,

                // animation speed
                // slow, normal, fast
                maxSpeed: 'fast',
                initSpeed: 'fast',

                // 0 = top
                // 90 = left
                // 135 = right-bottom
                direction: 135,

                // interact with cursor move on mouse out
                keep: true

            });
        }

        var colors = ['#39279a'];
        var random_color = colors[Math.floor(Math.random() * colors.length)];
        document.querySelector('.bubble-skills').style.color = random_color;
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