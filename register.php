<?php
require_once 'inc/LoginSystem.class.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$info = array(
    "userName" => $username,
    "userEmail" => $email,
    "userPassword" => $password
);

if (LoginSystem::register($info)) {
    header("Location: test.php");
    exit;
} else {
    die ("Noob");
}