<?php
require_once 'connection.php';
require_once '../authController.php';

include "logic.php";

if (isset($_SESSION['user'])) {
    header("location: index.php");
}

if (isset($_REQUEST['submit_btn'])) {
    $new_pass = strip_tags($_REQUEST['new-pass']);
    $repeat_new_pass = strip_tags($_REQUEST['repeat-new-pass']);
    header("location: login.php");
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
    <link rel="stylesheet" href="../styles/styles_header_footer.css">
    <link rel="stylesheet" href="../styles/logon-register-forgot-form.css">
    <link rel="stylesheet" href="../styles/forgot.css">
    <title>New password</title>
</head>

<body>
    <div id="particles-js"></div>
    <div class="container">
        <main>
            <div class="popup" id="popup" style="margin-bottom: 0px !important;">
                <form action="new_password.php" method="POST" style="display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  min-height: 100vh;">
                    <div class="form">
                        <h2>Reset your password</h2>
                        <div class="form-element">
                            <input type="password" id="email" name="new-pass" placeholder="New password" class="form-field">
                            <label for="new-pass" class="form-label">New password</label>
                        </div>
                        <div class="form-element">
                            <input type="password" id="email" name="repeat-new-pass" placeholder="Repeat password" class="form-field">
                            <label for="repeat-new-pass" class="form-label">Repeat password</label>
                            <?php
                            if (isset($errorMsg[0])) {
                                foreach ($errorMsg[0] as $nameErrors) {
                                    echo "<div class='error'>" . $nameErrors . "</div>";
                                }
                            }
                            ?>
                            <?php
                            if (isset($errorMsg[1])) {
                                foreach ($errorMsg[1] as $emailErrors) {
                                    echo "<div class='error'>" . $emailErrors . "</div>";
                                }
                            }
                            ?>
                        </div>
                        <div class="form-element">
                            <div class="button-wrapper">
                                <button type="submit" name="submit_btn">Reset Password</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>