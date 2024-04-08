<?php
    session_start();
    if (isset($_COOKIE["user"])) {
        unset($_COOKIE["user"]);
        setcookie("user", "", -1, "/");
    }

    if (!isset($_SESSION["username"])) {
        header("Location: index.php");
        exit;
    }
    if (isset($_GET['reset']) && $_GET['reset'] == 'true') {
        // Clear the game state
        unset($_SESSION['wrongGuesses']);
        unset($_SESSION['guessedLetters']);
        unset($_SESSION['selectedWord']);
    }
    
    if (isset($_GET['level'])) {
        $level = $_GET['level'];
        switch ($level) {
            case 'easy':
                header('Location: game.php?level=easy');
                exit;
            case 'medium':
                header('Location: game.php?level=medium');
                exit;
            case 'hard':
                header('Location: game.php?level=hard');
                exit;
            default:
                header('Location: game.php?level=easy');
                exit;
        }
    }

    if (isset($_POST["signOut"])) {
        unset($_SESSION["username"]);
        session_destroy();
        session_write_close();
        header("Location: index.php");
        exit;
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Team 10 - Hangman Word Game</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div id="gametitle">
            <h1>HANGMAN WORD GAME</h1>
        </div>

        <div id="menu">
            <div id="selection">
                <a href="game.php?level=easy"><button id="easy">EASY</button></a>
                <br>
                <a href="game.php?level=medium"><button id="medium">MEDIUM</button></a>
                <br>
                <a href="game.php?level=hard"><button id="hard">HARD</button></a>
                <br>
                <a href="leaderboard.php"><button>Leaderboard</button></a>
                <form action="./main_menu.php" method="post">
                    <input type="submit" name="signOut" value="Sign Out">
                </form>
            </div>
        </div>
    </body>
</html>
