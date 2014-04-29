<?php

require_once 'DatabaseSystem.class.php';
require_once 'EasyLoginSystem/User.class.php';
session_start();

class LoginSystem {

	public static function login($username, $password) {

		$tempUser = new User($username);

		if ($tempUser -> getPassword() != $password) {
			unset($tempUser);
			session_destroy();
			return false;
		}

		$_SESSION['user'] = $tempUser;
		$_SESSION['loggedIn'] = '1';

	}

	public static function logOut() {
		unset ($_SESSION['user']);
		unset ($_SESSION['loggedIn']);
	}

	public static function register($information) {
	}

	public static function getUser($userDetail) {
	}

	public static function verifyAccount($uid) {
	}

	public static function isAccountVerified($uid) {
	}

}
