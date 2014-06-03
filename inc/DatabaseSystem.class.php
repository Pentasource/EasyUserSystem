<?php

/**
 * class DatabaseSystem
 * Handles all database queries
 */
class DatabaseSystem {

	/*
	 * These are the connection details. Edit as appropriate.
	 * //
	 * Dies sind die Verbindungsdaten. Bitte anpassen.
	 *
	 *
	 * $db_host : IP address or domain of the database // IP-Addresse oder Domain der Datenbank
	 * $db_user : Username (usually 'root') // Benutzername (meistens 'root')
	 * $db_pass : Password // Passwort
	 * $dp_name : Name of the database // Name der Datenbank
	 *
	 */
	private static $db_host = "localhost";
	private static $db_user = "root";
	private static $db_pass = "password";
	private static $db_name = "test_db";

	/** stores MySQLi connection */
    /** @var  mysqli */
	private static $db_link;

	/**
	 * Connects to the database
	 */
	private static function connect() {
		self::$db_link = new mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);
		if (self::$db_link -> connect_error)
			return false;
		else
			return true;

	}

	/**
	 * Disconnects from the database
	 */
	private static function disconnect() {
		self::$db_link -> close();
	}

    /**
     * Executes a query
     * //
     * Führt eine Anfrage aus
     *
     * +-----------------------------------------------------------+
     * | !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! |
     * +-----------------------------------------------------------+
     * | Be sure to escape all user inputs before writing a query! |
     * | -> See escapeString() for more details!                   |
     * +-----------------------------------------------------------+
     *
     * +-----------------------------------------------------------+
     * | !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! |
     * +-----------------------------------------------------------+
     * | Achtung! Alle Benutzereingaben sollten in ein sicheres    |
     * | Format umgewandelt werden bevor sie an die Datenbank      |
     * | geschickt werden!                                         |
     * | -> Siehe escapeString() für weitere Details!               |
     * +-----------------------------------------------------------+
     *
     * Will return a result set if query succeeded or false if not.
     * @param $statement
     * @return mysqli_result | bool
     */
	public static function query($statement) {
		if (!self::connect()) {
			return false;
		}

		$result = self::$db_link -> query($statement);

		return $result;
	}

	/**
	 * Tests if the connection to the database is successful.
	 * //
	 * Testet, ob die Verbindung zur Datenbank erfolgreich ist.
	 *
	 * Will return true if connection succeeded or false if not.
	 * 	 * @return bool
	 */
	public static function testConnection() {
		if (!self::connect()) {
			self::disconnect();
			return false;
		} else {
			self::disconnect();
			return true;
		}
	}

	/**
	 * Returns the last error
	 * //
	 * Gibt den letzten Fehler zurück
	 * @return string
	 */
	public static function getLastError() {
		return self::$db_link -> error;
	}

	/**
	 * Returns the last error
	 * //
	 * Gibt den letzten Fehler zurück
	 * @return int
	 */
	public static function getLastErrorNo() {
		return self::$db_link -> errno;
	}

	/**
	 * Returns the ID of the last inserted row.
	 * //
	 * Gibt die ID der letzten eingefügten Reihe zurück
	 */
	public static function getLastInsertId() {
		$returnValue = self::$db_link -> insert_id;

		return ($returnValue > 0) ? $returnValue : false;
	}

	/**
	 * Escapes the string so that SQLInjections are prevented
	 * //
	 * Formatiert Sonderzeichen um SQLInjections zu verhindern
	 */
	public static function escapeString($string) {
		return self::$db_link -> real_escape_string($string);
	}

}
