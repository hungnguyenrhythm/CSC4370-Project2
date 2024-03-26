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
                <form method="get" action="./main_menu.php">
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