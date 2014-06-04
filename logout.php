<?php
require_once 'inc/LoginSystem.class.php';

LoginSystem::logOut();

header("Location: test.php");