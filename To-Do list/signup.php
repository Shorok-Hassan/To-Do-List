<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("connection.php");
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $q = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($link, $q)) {
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Error: " . mysqli_error($link);
        }
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Sign Up</h2>

    <?php if (isset($error_message)): ?>
        <div style="color: red; margin-bottom: 15px;">
            <strong><?php echo $error_message; ?></strong>
        </div>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
        <input type="submit" value="Sign Up">
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
