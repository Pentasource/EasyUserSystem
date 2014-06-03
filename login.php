<?php
require_once 'inc/LoginSystem.class.php';

ini_set("display_errors", 1);
error_reporting(E_ALL);

$username = $_POST['username'];
$password = $_POST['password'];

if (LoginSystem::login($username, $password)) {
    header("Location: test.php");
    exit;
} else {
    die ( "Login failed, Noob!");
}