<?php
$link = mysqli_connect("localhost", "root", "", "todo_db");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    exit;
}
?>
