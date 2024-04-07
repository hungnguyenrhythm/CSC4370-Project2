<?php
    session_start();

    $easy = ["cat", "dog", "car", "sun", "ball"];
    $medium = ["guitar", "elephant", "rainbow", "bicycle", "pizza"];
    $hard = ["algorithm", "phenomenon", "zephyr", "cryptography", "exacerbate"];

    $level = $_GET['level'] ?? 'easy';
    $score = isset($_COOKIE['score']) ? (int)$_COOKIE['score'] : 0;

    switch ($level) {
        case 'easy':
            $words = $easy;
            break;
        case 'medium':
            $words = $medium;
            break;
        case 'hard':
            $words = $hard;
            break;
    }

    if (isset($_GET['reset']) && $_GET['reset'] == 'true') {
        unset($_SESSION['wrongGuesses']);
        unset($_SESSION['guessedLetters']);
        unset($_SESSION['selectedWord']);
    }

    $wrongGuesses = $_SESSION['wrongGuesses'] ?? 0;
    $guessedLetters = $_SESSION['guessedLetters'] ?? [];

    if (!isset($_SESSION['selectedWord'])) {
        $_SESSION['selectedWord'] = $words[array_rand($words)];
    }

    $word = $_SESSION['selectedWord'];

    if (isset($_POST['letter']) && $wrongGuesses < 5) {
        $guess = strtolower($_POST['letter']);
        if (!in_array($guess, str_split($word))) {
            $wrongGuesses++;
        }
        if (!in_array($guess, $guessedLetters)) {
            $guessedLetters[] = $guess;
        }
        $_SESSION['wrongGuesses'] = $wrongGuesses;
        $_SESSION['guessedLetters'] = $guessedLetters;
    }

    $imageSrc = "./assets/image" . min($wrongGuesses+1, 6) . ".png";

    $wordDisplay = '';
    foreach (str_split($word) as $letter) {
        $wordDisplay .= in_array($letter, $guessedLetters) ? $letter : "_";
        $wordDisplay .= " ";
    }

    $rebuiltWord = '';
    foreach (str_split($word) as $letter) {
        $rebuiltWord .= in_array($letter, $guessedLetters) ? $letter : "_";
    }

    $isGameWon = $rebuiltWord == $word;
    if ($isGameWon) {
        $score++;
        $_SESSION['score'] = $score;
        setcookie('score', $score, time() + (86400 * 30), "/"); // Expires in 30 days
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangman Game</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>HANGMAN WORD GAME</h1>
    <div class="game-container"> 
        <div class="game-area">
            <div id="image">
                <img src="<?php echo $imageSrc; ?>" alt="Hangman image">
            </div>
            <div id="wordBoard">
                <?php echo $wordDisplay; ?>
            </div>
            <div class= "letterAndReturn">
                <div class= "letter-buttons">
                    <?php if ($wrongGuesses < 5 && !$isGameWon): ?>
                        <?php foreach(range('A', 'Z') as $letter): ?>
                            <?php if (!in_array(strtolower($letter), $guessedLetters)): ?>
                                <form method="post" class="letter-form">
                                    <input type="hidden" name="letter" value="<?php echo $letter; ?>">
                                    <button type="submit"><?php echo $letter; ?></button>
                                </form>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?php if ($wrongGuesses >= 5): ?>
                    <p>Game Over! <br> The word was <?php echo $word; ?>.</p>
                <?php elseif ($isGameWon): ?>
                    <p>Congratulations! <br> You've guessed the word correctly: <?php echo $word; ?>. <br> Your current score is <?php echo $score; ?></p>
                <?php endif; ?>
                <div class="return-menu">
                    <a href="main_menu.php?reset=true"><button>Return to Menu</button></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>