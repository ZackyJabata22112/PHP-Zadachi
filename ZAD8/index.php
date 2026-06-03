<?php
session_start();

if (!isset($_SESSION['secret_number'])) {
    $_SESSION['secret_number'] = rand(1, 10);
    $_SESSION['score'] = 0;              
    $_SESSION['current_points'] = 10;    
}

$message = "Guess the number between 1 and 10! You start with 10 points.";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guess'])) {
    $guess = intval($_POST['guess']);

    if ($guess === $_SESSION['secret_number']) {
        $message = "Congratualtions! You guessed the number " . $_SESSION['secret_number'] . " and won " . $_SESSION['current_points'] . " points this round! Guess again!";
        
        $_SESSION['score'] += $_SESSION['current_points']; 
        
        $_SESSION['secret_number'] = rand(1, 10);
        $_SESSION['current_points'] = 10; 
    } else {
        if ($_SESSION['current_points'] > 0) {
            $_SESSION['current_points']--;
        }

        if ($guess < $_SESSION['secret_number']) {
            $message = "Number is bigger! (-1 point)";
        } else {
            $message = "Number is smaller! (-1 point)";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadacha 8</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="game-container">
        <h1>Guess the number</h1>
        
        <div class="stats">
            Total Score: <strong><?php echo $_SESSION['score']; ?> points</strong><br>
            Points for next try: <strong><?php echo $_SESSION['current_points']; ?></strong>
        </div>

        <p class="message"><?php echo $message; ?></p>

        <form method="POST" action="index.php">
            <input type="number" name="guess" min="1" max="10" required autofocus>
            <br><br>
            <button type="submit" class="btn">Guess</button>
            <a href="reset.php" class="btn btn-reset">Restart</a>
        </form>
    </div>

</body>
</html>