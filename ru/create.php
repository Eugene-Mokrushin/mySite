<?php

require_once 'connection.php';
session_start();
include "logic.php";

if (isset($_SESSION['user']['name']) != 'Eugene') {
    header("location: blog.php");
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/create.css">
    <link rel="shortcut icon" type='x-icon' href="../photos/logo/capybara.svg">
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
    <title>Creating post</title>
</head>

<body>
    <div class="container">
        <div class="button-back">
            <a href="blog.php" class="go-back-link">
                <-- Go back</a>
        </div>
        <div class="main-filler">
            <form method="POST" enctype="multipart/form-data">
                <input type="text" placeholder="Blog Title" name="title" class="new-post-title">
                <div id="editorjs"></div>
                <input type="text" name="passContent" id="passer" hidden>
                <textarea type="text" name="pre_ru" id="preview"></textarea>
                <div class="drop-zone" id="backgroung">
                    <span class="drop-zone__prompt"> Drop image cover here or click to upload</span>
                    <input type="file" name="cover" class="drop-zone__input">
                </div>
                <button class="create-btn" name="new_post" id="save-all">Add new post</button>
            </form>
        </div>

        <script src="../scripts/create.js"></script>
        <!-- <script src="./createArticle.js"></script> -->
    </div>
</body>
<script src="create.js"></script>
<script>
    const ImageTool = window.ImageTool;
    const editor = new EditorJS({
        holder: 'editorjs',
        tools: {
            image: SimpleImage,
            header: {
                class: Header,
                config: {
                    placeholder: 'Enter a header',
                    levels: [1, 2, 3, 4],
                    defaultLevel: 3
                }
            },
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
            Marker: {
                class: Marker,
                shortcut: 'CMD+SHIFT+M',
            },
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
        }
    });
    let saveBtn = document.getElementById('save-all');

    saveBtn.addEventListener('click', function() {
        editor.save().then((outputData) => {
            var json_string = JSON.stringify(outputData);
            document.getElementById('passer').value = json_string
        })
    })
</script>

<script>
    function textAreaAdjust(element) {
        element.style.height = "600px";
        element.style.height = (25 + element.scrollHeight) + "px";
    }
</script>

</html>