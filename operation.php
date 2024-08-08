<?php

include("./conn.php");

if (isset($_POST['submit'])) {
    $name = $_POST['user'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE username = '$name' AND password = '$pass'";
    echo "well performed";
    $result =  mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        header('Location: home.php');
    } else {
        echo "Invalid credentials";
    }
}
