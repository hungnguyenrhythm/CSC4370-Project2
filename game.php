<?php
session_start();

// Define word lists
$easy = ["cat", "dog", "car", "sun", "ball"];
$medium = ["guitar", "elephant", "rainbow", "bicycle", "pizza"];
$hard = ["algorithm", "phenomenon", "zephyr", "cryptography", "exacerbate"];

// Determine the game level
$level = $_GET['level'] ?? 'easy';

// Assign the corresponding word list based on the selected level
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

// Reset game state if requested
if (isset($_GET['reset']) && $_GET['reset'] == 'true') {
    // Resetting the game
    unset($_SESSION['wrongGuesses']);
    unset($_SESSION['guessedLetters']);
    unset($_SESSION['selectedWord']);
    session_reset();
}

// Initialize or retrieve the wrong guess count and guessed letters
$wrongGuesses = $_SESSION['wrongGuesses'] ?? 0;
$guessedLetters = $_SESSION['guessedLetters'] ?? [];

// Select a new word only if not already set
if (!isset($_SESSION['selectedWord'])) {
    $_SESSION['selectedWord'] = $words[array_rand($words)];
}

// Retrieve the current word
$word = $_SESSION['selectedWord'];

// Process a letter guess
if (isset($_POST['letter']) && $wrongGuesses < 5) {
    $guess = strtolower($_POST['letter']);
    if (!in_array($guess, str_split($word))) {
        $wrongGuesses++;
    }
    // Add the guessed letter if not already guessed
    if (!in_array($guess, $guessedLetters)) {
        $guessedLetters[] = $guess;
    }
    $_SESSION['wrongGuesses'] = $wrongGuesses;
    $_SESSION['guessedLetters'] = $guessedLetters;
}

// Determine the image to display based on wrong guesses
$imageSrc = "./assets/image" . min($wrongGuesses+1, 5) . ".jpeg";

// Generate the display version of the word
$wordDisplay = '';
foreach (str_split($word) as $letter) {
    $wordDisplay .= in_array($letter, $guessedLetters) ? $letter : "_";
}

if ($wordDisplay == $word) {
    echo "Congratulations";
    session_destroy();
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
    <div class="game-container"> 
        <div class="game-area">
            <div id="image">
                <img src="<?php echo $imageSrc; ?>" alt="Hangman image">
            </div>
            <div id="wordBoard">
                <?php echo $wordDisplay; ?>
            </div>
            <div class="letter-buttons">
                <?php if ($wrongGuesses < 5): ?>
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
                <p>Game Over. The word was <?php echo $word; ?>.</p>
            <?php endif; ?>
            <a href="?reset=true">Reset Game</a>
        </div>
    </div>
</body>
</html>