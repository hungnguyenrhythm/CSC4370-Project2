<?php
    session_start();
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST["logInName"];
                    $password = $_POST["logInPassword"];
                    $userList = file("./users.txt", FILE_IGNORE_NEW_LINES);
                    $user = preg_grep("/"."^"."$username"."/", $userList);
                    if (count($user) == 0) {
                        echo "Username not found. Try again";
                        $login = "\"login.php\"";
                        echo "<a href=$login>Click here to go back to the login page.</a>";
                        exit();
                    }
                    $index = array_keys($user)[0];
                    $user = explode(",", $user[$index]);
                    if ($username == $user[0] and $password == $user[1]) {
                        $_SESSION["username"] = $username;
                        header("Location: menu.php");
                        exit();
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