<?php
    $conn = mysqli_connect("localhost:3306", " root", " ", "articles");
    $conn_comments = mysqli_connect("localhost:3306", " root", " ", "comments");
    $conn_users = mysqli_connect("localhost:3306", " root", " ", "users"); 
    $conn_wip_state = mysqli_connect("localhost:3306", " root", " ", "wip_current_state");   
    $conn_wip_projects = mysqli_connect("localhost:3306", " root", " ", "wip_projects");
    if(!$conn){
        echo "<h3 class='container bg-dark p-3 text-center text-warning rounded-lg mt-5'>Not able to establish Database Connection<h3>";
    }

    $sql = "SELECT * FROM data";
    $sql_last_two = "SELECT * FROM data ORDER BY id DESC LIMIT 2";
    $sql_comments = "SELECT * FROM comments";
    $sql_users = "SELECT * FROM users";
    $sql_wip_progress = "SELECT * FROM state";
    $sql_wip_projects = "SELECT * FROM wip_projects WHERE id < (SELECT MAX(id) FROM wip_projects) ORDER BY id DESC";
    $sql_wip_projects_first = "SELECT * FROM wip_projects ORDER BY id DESC LIMIT 0, 1";
    $query = mysqli_query($conn, $sql);
    $query_last_two = mysqli_query($conn, $sql_last_two);
    $query_comments = mysqli_query($conn_comments, $sql_comments);
    $query_users = mysqli_query($conn_users, $sql_users);
    $query_wip_progress = mysqli_query($conn_wip_state, $sql_wip_progress);
    $query_wip_projects = mysqli_query($conn_wip_projects, $sql_wip_projects);
    $query_wip_projects_first = mysqli_query($conn_wip_projects, $sql_wip_projects_first);

    if(isset($_REQUEST["new_project-de"])){
        $title_en = strip_tags($_REQUEST["title-en"]);
        $title_ru = strip_tags($_REQUEST["title-ru"]);
        $title_de = strip_tags($_REQUEST["title-de"]);
        $description_en = strip_tags($_REQUEST["text-en"]);
        $description_ru = strip_tags($_REQUEST["text-ru"]);
        $description_de = strip_tags($_REQUEST["text-de"]);

        $pname = rand(1000,10000)."-".$_FILES["cover"]["name"];
        $tname = $_FILES["cover"]["tmp_name"];

        // print_r($tname);

        $uploads_dir = 'C:\xampp\htdocs\projectsCovers';

        move_uploaded_file($tname, $uploads_dir.'/'.$pname);


        $sql_wip_progress = "INSERT INTO wip_projects(title_en, description_en, title_ru, description_ru, title_de, description_de, photo)  VALUES ('$title_en', '$description_en', '$title_ru', '$description_ru', '$title_de', '$description_de', '$pname')";
        mysqli_query($conn_wip_projects, $sql_wip_progress);

        header("location: wip.php");
        exit();
    }

    if(isset($_REQUEST["new_post"])){
        $title = strip_tags($_REQUEST["title"]);
        $content = $_REQUEST["passContent"];
        $privew = $_REQUEST["pre_ru"];

        $pname = rand(1000,10000)."-".$_FILES["cover"]["name"];
        $tname = $_FILES["cover"]["tmp_name"];

        // print_r($tname);

        $uploads_dir = 'C:\xampp\htdocs\covers';

        move_uploaded_file($tname, $uploads_dir.'/'.$pname);


        $sql = "INSERT INTO data(title, content, pre_en ,covers)  VALUES ('$title', '$content', '$privew','$pname')";
        mysqli_query($conn, $sql);

        header("location: blog.php?info=added");
        exit();
    }
    


    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];

        $sql = "SELECT * FROM data WHERE id = $id";
        $query = mysqli_query($conn, $sql);
        $sql_comments = "SELECT * FROM comments WHERE postId = $id ORDER BY date_posted DESC";
        $query_comments = mysqli_query($conn_comments, $sql_comments);
    }


    if(isset($_REQUEST['update'])){
        $title = strip_tags($_REQUEST["title"]);
        $content = strip_tags($_REQUEST["passContent"]);
        $id = $_REQUEST['id'];

        $sql = "UPDATE data SET title = '$title', content = '$content' WHERE id = $id";
        mysqli_query($conn, $sql);
        header("location: view.php?id=".$id);
        exit();
    }

    if(isset($_REQUEST['save-progress'])){
        $new_state = $_REQUEST["progress-done"];

        $sql_wip_progress = "UPDATE state SET state = '$new_state'";
        mysqli_query($conn_wip_state, $sql_wip_progress);
        header("location: wip.php");
        exit();

    }

    if(isset($_REQUEST['submit-comment'])){
        $comment = strip_tags($_REQUEST["newcommnet"]);
        $userId = $_REQUEST["session-id"];
        $postId = $_REQUEST['post-id'];

        $sql_comments = "INSERT INTO comments(userId, postId, content)  VALUES ('$userId', '$postId', '$comment')";
        mysqli_query($conn_comments, $sql_comments);
        header("location: view.php?id=".$postId."#seneder");
        exit();
    }

    if(isset($_REQUEST['delete'])){
        $id = $_REQUEST['id'];

        $sql = "DELETE FROM data WHERE id = $id";
        $query = mysqli_query($conn, $sql);
        
        header("location: blog.php");
        exit();
        
    }

    if(isset($_REQUEST['delete-comment'])){
        $id_comment = $_REQUEST['id-comment'];
        $postId = $_REQUEST['post-id'];
        $sql_comments = "DELETE FROM comments WHERE id = $id_comment";
        $query_comments = mysqli_query($conn_comments, $sql_comments);
        
        header("location: view.php?id=".$postId."#comments");
        exit();
        
    }




?>