<?php

require_once 'DatabaseSystem.class.php';
require_once 'EasyLoginSystem/User.class.php';
session_start();

class LoginSystem {

	public static function login($username, $password) {

		$tempUser = new User($username);

		if ($tempUser -> getPassword() != self::hash($password)) {
			unset($tempUser);
			session_destroy();
			return false;
		}

		$_SESSION['user'] = $tempUser;
		$_SESSION['loggedIn'] = '1';

	}

	public static function logOut() {
		unset($_SESSION['user']);
		unset($_SESSION['loggedIn']);
	}

	public static function userExists($uid) {

		$statement = <<<SQL
	
			SELECT *
			FROM users
			WHERE uid=$uid
		
SQL;

		$result = DatabaseSystem::query($statement);

		return ($result -> num_rows > 0) ? true : false;

	}

	public static function register($information) {

		$userName = $information['username'];
		$userEmail = $information['userEmail'];
		$userPassword = self::hash($information['userPassword']);

		$statement = <<<SQL
	
			INSERT INTO users
			(uid, userName, userEmail, userPassword, isAdmin, isVerified)
			VALUES
			(NULL, '$userName', '$userEmail', '$userPassword', '0', '0');
	
SQL;

		DatabaseSystem::query($statement);
		
		return DatabaseSystem::getLastInsertId();

	}

	public static function getUser($userDetail) {
		return new User($userDetail);
	}

	public static function verifyAccount($uid) {
		$user = self::getUser($uid) -> changeVerified("1");
	}

	public static function isAccountVerified($uid) {
		$user = self::getUser($uid);
		return $user -> isVerified();
	}
	
	private static function hash($string) {
		return md5(sha1($string));
	}

}
