

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        /* Your CSS styles */
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login admin </h2>
        <form method="post" action="admin_dashboard.html">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
            <button type="reset" class="secondary-btn">Cancel</button>
        </form>
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
