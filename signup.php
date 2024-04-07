
<!DOCTYPE html>
<html>
    <head>
        <title>Team 10 - Hangman - Sign Up</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="center">
            <h1>Sign Up</h1>
        </div>
        <div class="selection">
            <fieldset class="form">
                <legend>Sign Up</legend>
                <form method="get" action="./login.php">
                    <label for="signUpName">Set your username:</label><br>
                    <input type="text" id="signUpName" name="signUpName" size="60" required><br><br>
                    <label for="signUpPassword">Set your password:</label><br>
                    <input type="text" id="signUpPassword" name="signUpPassword" size="60" required><br><br>
                    <input type="submit" value="Register">
                </form>
            </fieldset>
        </div>
    </body>
</html>