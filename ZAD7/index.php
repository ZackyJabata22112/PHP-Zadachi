<?php

$display = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = isset($_POST['num1']) ? trim($_POST['num1']) : '';
    $num2 = isset($_POST['num2']) ? trim($_POST['num2']) : '';
    $operator = isset($_POST['operator']) ? $_POST['operator'] : '';

    if ($num1 === '' || $num2 === '') {
        $error = "Please enter both numbers!";
    } elseif (!is_numeric($num1) || !is_numeric($num2)) {
        $error = "Both values must be numeric!";
    } else {
        $num1 = (float)$num1;
        $num2 = (float)$num2;
        $result = 0;
        $valid = true;

        switch ($operator) {
            case '+': $result = $num1 + $num2; break;
            case '-': $result = $num1 - $num2; break;
            case '*': $result = $num1 * $num2; break;
            case '/': 
                if ($num2 == 0) {
                    $error = "Division by zero is impossible!";
                    $valid = false;
                } else {
                    $result = $num1 / $num2;
                }
                break;
            default:
                $error = "Invalid operator!";
                $valid = false;
        }

        if ($valid) {
            $display = "$num1 $operator $num2 = $result";
            
            $logEntry = "[" . date('Y-m-d H:i:s') . "] " . $display . PHP_EOL;
            
            file_put_contents('history.txt', $logEntry, FILE_APPEND);
        }
    }
}

if (isset($_POST['clear_history'])) {
    if (file_exists('history.txt')) {
        unlink('history.txt');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadacha 7</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="calculator">
        <h2>CALCULATOR</h2>
        
        <div class="screen">
            <?php 
                if ($error) echo "<span class='error'>$error</span>";
                elseif ($display) echo htmlspecialchars($display);
                else echo "<span style='color:#6b7280;'>0</span>";
            ?>
        </div>

        <form method="POST" action="">
            <div class="form-group">
                <label>First Number</label>
                <input type="number" step="any" name="num1" value="<?php echo isset($_POST['num1']) ? htmlspecialchars($_POST['num1']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label>Operation</label>
                <select name="operator">
                    <option value="+" <?php echo (isset($_POST['operator']) && $_POST['operator'] == '+') ? 'selected' : ''; ?>>+ (Addition)</option>
                    <option value="-" <?php echo (isset($_POST['operator']) && $_POST['operator'] == '-') ? 'selected' : ''; ?>>- (Subtraction)</option>
                    <option value="*" <?php echo (isset($_POST['operator']) && $_POST['operator'] == '*') ? 'selected' : ''; ?>>* (Multiplication)</option>
                    <option value="/" <?php echo (isset($_POST['operator']) && $_POST['operator'] == '/') ? 'selected' : ''; ?>>/ (Division)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Second Number</label>
                <input type="number" step="any" name="num2" value="<?php echo isset($_POST['num2']) ? htmlspecialchars($_POST['num2']) : ''; ?>" required>
            </div>

            <button type="submit">CALCULATE</button>
        </form>
    </div>

    <div class="history-box">
        <div class="history-title">
            <span>Recent Logs:</span>
            <?php if (file_exists('history.txt')): ?>
                <form method="POST" style="display:inline;">
                    <button type="submit" name="clear_history" class="clear-btn">Clear</button>
                </form>
            <?php endif; ?>
        </div>
        <pre><?php 
            if (file_exists('history.txt') && filesize('history.txt') > 0) {
                echo htmlspecialchars(file_get_contents('history.txt'));
            } else {
                echo "No history recorded yet.";
            }
        ?></pre>
    </div>
</div>

</body>
</html>