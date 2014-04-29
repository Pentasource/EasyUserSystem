<?php

class PersonalInformation {

	private $firstName;
	private $lastName;
	private $dateOfBirth;
	private $street;
	private $houseNumber;
	private $town;
	private $postCode;
	private $emailVisible;
	private $phoneNumber;

	public function __construct($userId) {
		$this->fetchInformation();
	}

	public function refresh() {
		$this->fetchInformation();
	}

	private function fetchInformation() {

		$statement = <<<SQL
	
			SELECT *
			FROM personal_information
			WHERE uid=$userId
		
SQL;

		$personalInformation = Database::query($statement) -> fetch_array(MYSQLI_ASSOC);

		$this -> setFirstName($personalInformation['firstName']);
		$this -> setLastName($personalInformation['lastName']);
		$this -> setDateOfBirth($personalInformation['dateOfBirth']);
		$this -> setStreet($personalInformation['street']);
		$this -> setHouseNumber($personalInformation['houseNumber']);
		$this -> setTown($personalInformation['town']);
		$this -> setPostCode($personalInformation['postCode']);
		$this -> setEmailVisible($personalInformation['emailVisible']);
		$this -> setPhoneNumber($personalInformation['phoneNumber']);

	}

	private function setFirstName($firstName) {
		$this -> firstName = $firstName;
	}

	public function getFirstName() {
		return $this -> firstName;
	}

	public function changeFirstName() {
		//TODO
	}

	private function setLastName($lastName) {
		$this -> lastName = $lastName;
	}

	public function getLastName() {
		return $this -> lastName;
	}

	public function changeLastName($lastName) {
		//TODO
	}

	private function setDateOfBirth($dateOfBirth) {
		$this -> dateOfBirth = $dateOfBirth;
	}

	public function getDateOfBirth() {
		return $this -> dateOfBirth;
	}

	public function changeDateOfBirth($dateOfBirth) {
		//TODO
	}

	private function setStreet($street) {
		$this -> street = $street;
	}

	public function getStreet() {
		return $this -> street;
	}

	public function changeStreet($street) {
		//TODO
	}

	private function setHouseNumber($houseNumber) {
		$this -> houseNumber = $houseNumber;
	}

	public function getHouseNumber() {
		return $this -> houseNumber;
	}

	public function changeHouseNumber($houseNumber) {
		//TODO
	}

	private function setTown($town) {
		$this -> town = $town;
	}

	public function getTown() {
		return $this -> town;
	}

	public function changeTown($town) {
		//TODO
	}

	private function setPostCode($postCode) {
		$this -> postCode = $postCode;
	}

	public function getPostCode() {
		return $this -> postCode;
	}

	public function changePostCode($postCode) {
		//TODO
	}

	private function setEmailVisible($emailVisible) {
		$this -> emailVisible = $emailVisible;
	}

	public function isEmailVisible() {
		return $this -> emailVisible;
	}

	public function changeEmailVisible($emailVisible) {
		//TODO
	}

	private function setPhoneNumber($phoneNumber) {
		$this -> phoneNumber = $phoneNumber;
	}

	public function getPhoneNumber() {
		return $this -> phoneNumber;
	}

	public function changePhoneNumber($phoneNumber) {
		//TODO
	}

}
