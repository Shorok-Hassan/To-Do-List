<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION["user_id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
     
</head>
<body>
<div class="container">

    <div style="text-align: right;">
        <form method="post" action="logout.php" style="display:inline;">
            <input type="submit" value="Logout" style="background-color: #e74c3c; color: white; border: none; padding: 8px 15px; border-radius: 8px; cursor: pointer; font-size: 1em;">
        </form>
    </div>

    <h2>To-Do List</h2>

    <form method="post">
        <input type="text" name="id" placeholder="Task ID"><br>
        <input type="text" name="title" placeholder="Task Title"><br>
        <input type="submit" name="add" value="Add Task">
        <input type="submit" name="delete" value="Delete Task">
        <input type="submit" name="display" value="Display Tasks">
    </form>

<?php
include("connection.php");

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $q = "INSERT INTO tasks (title, user_id) VALUES ('$title', $user_id)";
    $res = mysqli_query($link, $q);
    if ($res) echo "<h3>Task Added</h3>";
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $q = "DELETE FROM tasks WHERE id = $id AND user_id = $user_id";
    $res = mysqli_query($link, $q);
    if ($res) echo "<h3>Task Deleted</h3>";
}

if (isset($_POST['display'])) {
    $q = "SELECT * FROM tasks WHERE user_id = $user_id";
    $res = mysqli_query($link, $q);

    echo "<h3>Your Tasks:</h3><table><tr><th>ID</th><th>Title</th></tr>";
    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr><td>{$row['id']}</td><td>{$row['title']}</td></tr>";
    }
    echo "</table>";
}

mysqli_close($link);
?>
</div>
</body>
</html>
