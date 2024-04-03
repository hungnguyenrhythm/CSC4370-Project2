<?php
    $easy=["cat", "dog", "car", "sun", "ball"];
    $medium=["guitar", "elephant", "rainbow", "bicycle", "pizza"];
    $hard=["algorithm", "phenomenon", "zephyr", "cryptography", "exacerbate"];

    $image=["image1.jpeg", "image2.jpeg", "image3.jpeg", "image4.jpeg", "image5.jpeg", "image6.jpeg"];

    switch($level) {
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
    
    $wrongGuesses = 0;
    
    while($wrongGuesses<5) {
        if(isset($_POST['guess'])) {
            $guess = $_POST['guess'];
            if(strpos($word, $guess) === false) {
                // Increment the number of wrong guesses
                $wrongGuesses++;
            }
        }
        if ($wrongGuesses==5) {
            header(ocation:'gameover.php');
            exit;
        }

        $imageIndex = min($wrongGuesses, count($images) - 1); 
        $imageSrc = "./assets/" . $images[$imageIndex];

        $wordDisplay = '';
        foreach(str_split($word) as $letter) {
            if(isset($_POST['guess']) && strpos($_POST['guess'], $letter) !== false) {
                $wordDisplay .= $letter;
            } else {
                $wordDisplay .= "_";
            }
            $wordDisplay .= " ";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangman Game</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div>
        <div id="image">
            <img src="<?php echo $imageSrc; ?>" alt="Hangman image">
        </div>
        <div id="wordBoard">
            <?php
            foreach(str_split($word) as $letter) {
                if(isset($_POST['guess']) && strpos($_POST['guess'], $letter) !== false) {
                    echo $letter;
                } else {
                    echo "_";
                }
                echo " ";
            }
            ?>
        </div>
    </div>

    <form method="post">
        <label for="guess">Enter a letter:</label>
        <input type="text" id="guess" name="guess" maxlength="1" required>
        <button type="submit">Guess</button>
    </form>
</body>
</html>