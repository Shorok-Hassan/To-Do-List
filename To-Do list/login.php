<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("connection.php");
    $username = $_POST["username"];
    $password = $_POST["password"];

    $q = "SELECT * FROM users WHERE username='$username'";
    $res = mysqli_query($link, $q);
    $user = mysqli_fetch_assoc($res);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        header("Location: todo.php");
        exit();
    } else {
        $error_message = "Invalid credentials.";
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    
    <?php if (isset($error_message)): ?>
        <div style="color: red; margin-bottom: 15px;">
            <strong><?php echo $error_message; ?></strong>
        </div>
    <?php endif; ?>
    
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="signup.php">Sign up</a></p>
</div>
</body>
</html>
