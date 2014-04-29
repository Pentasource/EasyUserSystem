<?php

require_once 'PersonalInformation.class.php';

class User {

	private $userId;
	private $userName;
	private $userEmail;
	private $userPassword;
	private $isAdmin;
	private $isVerified;
	private $personalInformation;

	public function __construct($userDetail) {

		if (is_numeric($userDetail)) {
			//$userDetail is ID

			$statement = <<<SQL
				
				SELECT *
				FROM users
				WHERE uid=$userDetail
				
SQL;

		} elseif (filter_var($userDetail, FILTER_VALIDATE_EMAILI)) {
			//$userDetail is Email

			$statement = <<<SQL
				
				SELECT *
				FROM users
				WHERE userEmail=$userDetail
				
SQL;

		} else {
			//$userDetail is username

			$statement = <<<SQL
				
				SELECT *
				FROM users
				WHERE userName=$userDetail
				
SQL;

		}

		$information = Database::query($statement) -> fetch_array(MYSQLI_ASSOC);

		$this -> setUserId($information['uid']);
		$this -> setUserName($information['userName']);
		$this -> setUserEmail($information['userEmail']);
		$this -> setUserPassword($information['userPassword']);
		$this -> setAdmin($information['isAdmin']);
		$this -> setAdmin($information['isVerified']);

		$this -> personalInformation = new PersonalInformation($this -> getUserId());

	}

	public function setUserId($userId) {
		$this -> userId = $userId;
	}

	public function getUserId() {
		return $this -> userId;
	}

	private function setUserName($userName) {
		$this -> userName = $userName;
	}

	public function getUserName() {
		return $this -> userName;
	}

	public function changeUserName($userName) {
		//TODO
	}

	private function setUserEmail($userEmail) {
		$this -> userEmail = $userEmail;
	}

	public function getUserEmail() {
		return $this -> userEmail;
	}

	public function changeUserMail($userMail) {
		//TODO
	}

	private function setUserPassword($userPassword) {
		$this -> userPassword = $userPassword;
	}

	public function getUserPassword() {
		return $this -> userPassword;
	}

	public function changeUserPassword($userPassword) {
		//TODO
	}

	private function setAdmin($isAdmin) {
		$this -> isAdmin = $isAdmin;
	}

	public function isAdmin() {
		return $this -> isAdmin;
	}

	public function changePermission($isAdmin) {
		//TODO
	}

	private function setVerified($isVerified) {
		$this -> isVerified = $isVerified;
	}

	public function isVerified() {
		return $this -> isVerified;
	}

	public function changeVerified($isVerified) {
		//TODO
	}

	public function getPersonalInformation() {
		return $this -> personalInformation;
	}

}