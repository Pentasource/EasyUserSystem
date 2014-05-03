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

	/**
	 * constructor
	 * @param $userDetail 	: UID, UserName or Email
	 */
	public function __construct($userDetail) {

		if (is_numeric($userDetail)) {
			//$userDetail is ID

			$statement = <<<SQL
				
				SELECT *
				FROM users
				WHERE uid='$userDetail'
				
SQL;

		} elseif (filter_var($userDetail, FILTER_VALIDATE_EMAIL)) {
			//$userDetail is Email

			$statement = <<<SQL
				
				SELECT *
				FROM users
				WHERE userEmail='$userDetail'
				
SQL;

		} else {
			//$userDetail is username

			$statement = <<<SQL
				
				SELECT *
				FROM users
				WHERE userName='$userDetail'
				
SQL;

		}

		$information = DatabaseSystem::query($statement) -> fetch_array(MYSQLI_ASSOC);

		$this -> setUserId($information['uid']);
		$this -> setUserName($information['userName']);
		$this -> setUserEmail($information['userEmail']);
		$this -> setUserPassword($information['userPassword']);
		$this -> setAdmin($information['isAdmin']);
		$this -> setAdmin($information['isVerified']);

		$this -> personalInformation = new PersonalInformation($this -> getUserId());

	}

	/**
	 *	ALL FOLLOWING FUNCTIONS SHOULD BE SELF-EXPLANATORY
	 * ======
	 * (The difference between Set and Change is that set only affects the server copy of the user (i.e. this class) where as change also updates the database)
	 */

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
		$statement = <<<SQL
		
		UPDATE users
		SET userName='$userName'
		WHERE uid={$this->getUserId()}
		
SQL;

		return DatabaseSystem::query($statement);

	}

	private function setUserEmail($userEmail) {
		$this -> userEmail = $userEmail;
	}

	public function getUserEmail() {
		return $this -> userEmail;
	}

	public function changeUserMail($userMail) {
		$statement = <<<SQL
		
		UPDATE users
		SET userEmail='$userEmail'
		WHERE uid={$this->getUserId()}
		
SQL;

		return DatabaseSystem::query($statement);

	}

	private function setUserPassword($userPassword) {
		$this -> userPassword = $userPassword;
	}

	public function getUserPassword() {
		return $this -> userPassword;
	}

	public function changeUserPassword($userPassword) {
		$statement = <<<SQL
		
		UPDATE users
		SET userPassword='$userPassword'
		WHERE uid={$this->getUserId()}
		
SQL;

		return DatabaseSystem::query($statement);

	}

	private function setAdmin($isAdmin) {
		$this -> isAdmin = $isAdmin;
	}

	public function isAdmin() {
		return $this -> isAdmin;
	}

	public function changePermission($isAdmin) {
		$statement = <<<SQL
		
		UPDATE users
		SET isAdmin='$isAdmin'
		WHERE uid={$this->getUserId()}
		
SQL;

		return DatabaseSystem::query($statement);

	}

	private function setVerified($isVerified) {
		$this -> isVerified = $isVerified;
	}

	public function isVerified() {
		return $this -> isVerified;
	}

	public function changeVerified($isVerified) {
		$statement = <<<SQL
		
		UPDATE users
		SET isVerified='$isVerified'
		WHERE uid={$this->getUserId()}
		
SQL;

		return DatabaseSystem::query($statement);

	}

	public function getPersonalInformation() {
		return $this -> personalInformation;
	}

}
