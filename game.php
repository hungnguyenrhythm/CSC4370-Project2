<!DOCTYPE html>
<html>
<head>
        <title>Team 10 - Hangman</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css">
</head>
    <body>
        <?php
            if (isset($_POST["tries"])) {
                $tries = $_POST["tries"];
            } else {
                $tries = 0;
            }
            $maxx_guesses = 6;
            $wordList = file("./words.txt", FILE_IGNORE_NEW_LINES);
            $word = $wordList[array_rand($wordList)];
            $wordCharacter = str_split($word);
            $guess = str_repeat("_", count($wordCharacter));
            $guessCharacter = str_split($guess);
            $update = "";
            if (isset($_POST["guess"])) {
                $character = $_POST["guess"];
                for ($i=0; $i<count($wordCharacter); $i++) {
                    if ($character == $wordCharacter[$i] and !in_array($character, $guessCharacter)) {
                        $guessCharacter[$i] = $character;
                    }
                }
                for ($j=0; $j<count($guessCharacter); $j++) {
                    $update .= $guessCharacter[$j];
                }
                $guess = $update;
                echo "$guess<br>";
            }
        ?>
        <h1>GUESS THE WORD</h1>
        <div id="guessBox">
        <form method="post" id="hangMan">
            <label for="guess">Guess the character: </label><input type="text" name="guess" id="guess" size="30" maxlength="1" required>
            <input type="hidden" name="tries" value="<?php echo $tries?>">
        </form>
        </div>
    </body>
</html>