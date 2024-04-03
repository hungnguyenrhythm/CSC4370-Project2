<?php
    session_start();
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST["logInName"];
                    $password = $_POST["logInPassword"];
                    if ($username == "Test" and $password == "1234") {
                        $_SESSION["access"] = 1;
                        $_SESSION["username"] = $username;
                        header('Location: main_menu.php');
                        exit;
                    } else {
                        echo "Incorrect Password or Username";
                    }
                }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Team 10 - Hangman - Log In</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="center">
            <h1>Return User</h1>
        </div>
        <div class="selection">
            <fieldset class="form">
                <legend>Login</legend>
                <form method="post" action="login.php">
                    <label for="logInName">Enter your Username:</label><br>
                    <input type="text" id="logInName" name="logInName" size="60"><br><br>
                    <label for="logInPassword">Enter your Password:</label><br>
                    <input type="text" id="logInPassword" name="logInPassword" size="60"><br><br>
                    <input type="submit" value="Sign In">
                </form>
            </fieldset>
        </div>
    </body>
</html>