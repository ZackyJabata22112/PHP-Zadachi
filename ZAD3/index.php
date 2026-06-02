<?php include('regex.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadacha 3</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-container">
    <h2>Account <span>Login</span></h2>

    <?php if ($success): ?>
        <div class="success-text"><?php echo $success; ?></div>
    <?php endif; ?>

    <form action="index.php" method="POST">
        
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
            <?php if ($user_error): ?>
                <div class="error-text"><?php echo $user_error; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <?php if ($pass_error): ?>
                <div class="error-text"><?php echo $pass_error; ?></div>
            <?php endif; ?>
        </div>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>