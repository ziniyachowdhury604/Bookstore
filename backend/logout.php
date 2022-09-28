<?php
session_start();
unset($_SESSION["email"]);
unset($_SESSION["role"]);
unset($_SESSION["success"]);
unset($_SESSION["name"]);
header("Location: /bookstore/pages/login.php");
?>