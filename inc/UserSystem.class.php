<?php

require_once 'DatabaseSystem.class.php';
require_once 'EasyLoginSystem/User.class.php';
session_start();

class LoginSystem {

	public static function login($userDetail, $password) {

		$tempUser = new User($userDetail);

		if ($tempUser -> getUserPassword() != self::hash($password)) {
			unset($tempUser);
			session_destroy();
			return false;
		}

		$_SESSION['user'] = $tempUser;
		$_SESSION['loggedIn'] = '1';
		return true;

	}

	public static function logOut() {
		unset($_SESSION['user']);
		unset($_SESSION['loggedIn']);
	}

	public static function userExists($uid) {

		$user = new User($uid);
		return ($user -> getUserId() > 0) ? true : false;

	}

	public static function isLoggedIn() {
		return (isset($_SESSION['loggedIn']) && ($_SESSION['loggedIn']) == '1') ? true : false;
	}

	public static function register($information) {

		$userName = $information['userName'];
		$userEmail = $information['userEmail'];
		$userPassword = self::hash($information['userPassword']);

		if (LoginSystem::userExists($userName) || LoginSystem::userExists($userEmail)) {
			return false;
		}

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
