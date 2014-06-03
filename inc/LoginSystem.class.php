<?php

require_once 'DatabaseSystem.class.php';
require_once 'EasyLoginSystem/User.class.php';
session_start();

/**
 * Handles all login-related stuff
 * @class LoginSystem
 */
class LoginSystem {

    /**
     * login the user with supplied userDetail and password
     * @param $userDetail : UID, UserName or Email
     * @param $password : password
     * @return bool
     */
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

	/**
	 * clear session and log out
	 */
	public static function logOut() {
		unset($_SESSION['user']);
		unset($_SESSION['loggedIn']);
	}

    /**
     * checks if the user with the supplied userDetail exists
     * @param $userDetail : UID, UserName or Email
     * @return bool
     */
	public static function userExists($userDetail) {

		$user = new User($userDetail);
		return ($user -> getUserId() > 0) ? true : false;

	}

	/**
	 * checks if the current user is logged in
	 */
	public static function isLoggedIn() {
		return (isset($_SESSION['loggedIn']) && ($_SESSION['loggedIn']) == '1') ? true : false;
	}

    /**
     * creates a new user
     * @param $information : array(
     *        "username",
     *        "userEmail",
     *        "userPassword"
     * )
     * @return bool
     */
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

    /**
     * returns a User-object
     * @param $userDetail : UID, UserName or Email
     * @return \User
     */
	public static function getUser($userDetail) {
		return new User($userDetail);
	}

    /**
     * Sets the account to be verified
     * @param $uid
     * @internal param $userDetail : UID, UserName or Email
     */
	public static function verifyAccount($uid) {
		$user = self::getUser($uid) -> changeVerified("1");
	}

    /**
     * checks if the account is verified
     * @param $uid
     * @return
     * @internal param $userDetail : UID, UserName or Email
     */
	public static function isAccountVerified($uid) {
		$user = self::getUser($uid);
		return $user -> isVerified();
	}

    /**
     * hashes a string
     * @param $string : the string to be hashed
     * @return string
     */
	private static function hash($string) {
		return md5(sha1($string));
	}

}
