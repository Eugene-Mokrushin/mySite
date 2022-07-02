<?php

require_once 'connection.php';
include "logic.php";

session_start();

?>
<?php

include "logic.php";

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="stylesheet" href="../styles/view.css">
    <link rel="shortcut icon" type='x-icon' href="../photos/logo/capybara.svg">
    <title>Blog</title>
</head>

<body>

    <div class="container">
        <a id="button-to-top"></a>
        <?php foreach ($query as $q) { ?>
            <?php
            if (isset($_SESSION['user']) and $_SESSION['user']['email'] == ' ') { ?>
                <div class="delete-edit">
                    <a href="edit.php?id=<?php echo $q['id']; ?>" class="edit">Edit</a>
                    <form method="POST">
                        <input type="text" hidden name="id" value="<?php echo $q['id']; ?>">
                        <button name="delete">Delete</button>
                    </form>
                </div>
            <?php } ?>
            <div class="title-picture-wrapper" style="background-image: url(../covers/<?php echo $q['covers']; ?>); background-position: center center; background-size: cover;">
                <div class="glass">
                    <h1><?php echo $q['title']; ?></h1>
                </div>
            </div>
            <div class="main-text-wrapper">
                <div class="next-prevous-wrapper">
                    <div class="back-to-blog"><a href="blog.php">&#10229; Back to blog</a></div>
                    <div class="timestamp"><?php $timestamp = strtotime($q['time_created']);
                                            echo date("d.m.Y", $timestamp); ?></div>
                </div>
                <div id="editorjs"></div>
            </div>
        <?php } ?>
        <div class="comments-wrapper-wrapper">
            <div class="comments-wrapper">
                <?php
                if (isset($_SESSION['user'])) { ?>
                    <button onclick="openNewComment()" class="add-comment">&plus; Add comment</button>
                <?php } ?>
                <?php
                if (isset($_SESSION['user']) == false) { ?>
                    <div class="not-logged-in">
                        <a href="login.php">Log in</a> or <a href="register.php">register</a> to leave a&nbsp;comment!
                    </div>
                <?php } ?>
                <div class="add-comment-main" style="display: none;">
                    <form method="POST" class="sub-comment">
                        <div class="nice">Please be nice &#128522;:</div>
                        <input type="text" name="session-id" value="<?php echo $_SESSION['user']['name']; ?>" hidden>
                        <?php foreach ($query as $q) { ?>
                            <input type="text" name="post-id" value="<?php echo $q['id'] ?>" hidden>
                        <?php } ?>
                        <textarea name="newcommnet" onkeyup="textAreaAdjust(this)" style="overflow:hidden"></textarea>
                        <div class="submit-wrapper">
                            <button name="submit-comment">Send</button>
                        </div>
                    </form>
                </div>
                <div class="sender" id="seneder"></div>
                <?php foreach ($query_comments as $q_c) { ?>
                    <div class="comment-wrapper-wrapper" id="comments">
                        <div class="comment">
                            <div class="name-date">
                                <p class="userID"><?php echo $q_c['userId'] ?></p>
                                <p class="timeStamp"><?php $timestamp = strtotime($q_c['date_posted']);
                                                        echo date("m:H d.m.Y", $timestamp); ?></p>
                            </div>
                            <div class="text">
                                <p class="content"><?php echo $q_c['content'] ?></p>
                                <?php if ((isset($_SESSION['user']) and $_SESSION['user']['name'] == $q_c['userId']) or (isset($_SESSION['user']) and $_SESSION['user']['email'] == ' ')) { ?>
                                    <form method="POST" class="delete-form">
                                        <?php foreach ($query as $q) { ?>
                                            <input type="text" name="post-id" value="<?php echo $q['id'] ?>" hidden>
                                        <?php } ?>
                                        <input type="text" hidden name="id-comment" value="<?php echo $q_c['id']; ?>">
                                        <button name="delete-comment">Delete</button>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script>
        var btn = $("#button-to-top");
        $(window).scroll(function() {
            300 < $(window).scrollTop() ? btn.addClass("show") : btn.removeClass("show")
        });
        btn.on("click", function(a) {
            a.preventDefault();
            $("html, body").animate({
                scrollTop: 0
            }, "300")
        });
    </script>
    <script>
        function textAreaAdjust(element) {
            element.style.height = "20px";
            element.style.height = (25 + element.scrollHeight) + "px";
        }
    </script>
    <script>
        function openNewComment() {
            document.querySelector(".add-comment-main").style.display = 'initial';
            document.querySelector(".add-comment").style.display = 'none';
        }
    </script>
    <script>
        const editor = new EditorJS({
            readOnly: true,
            /**
             * Id of Element that should contain the Editor
             */
            holder: 'editorjs',

            /**
             * Available Tools list.
             * Pass Tool's class or Settings object for each Tool you want to use
             */
            tools: {
                header: {
                    class: Header,
                    config: {
                        placeholder: 'Enter a header',
                        levels: [1, 2, 3, 4],
                        defaultLevel: 3
                    }
                },
                image: SimpleImage,
                quote: {
                    class: Quote,
                    inlineToolbar: true,
                    shortcut: 'CMD+SHIFT+O',
                    config: {
                        quotePlaceholder: 'Enter a quote',
                        captionPlaceholder: 'Quote\'s author',
                    },
                },
                paragraph: {
                    class: Paragraph,
                    inlineToolbar: true,
                },
                warning: Warning,
                list: {
                    class: NestedList,
                    inlineToolbar: true,
                },
                delimiter: Delimiter,
                embed: {
                    class: Embed,
                    config: {
                        services: {
                            youtube: true,
                            codepen: true
                        }
                    }
                }
            },

            data: <?php echo $q['content']; ?>


        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>

</html>