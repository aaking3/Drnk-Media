<?php

require "db_configuration.php";

class SQLConnection {

	private $mysqliConnection;
	private $tables;

	public function __construct() {
		
	}

	public function initialize() {
		$this->connectToServer();
		$this->initializeDB();
		$this->selectDB();
		$this->initializeTables();
		$this->close();
	}

	public function addTable($sqlToCreateTable) {
		$this->tables[] = $sqlToCreateTable;
	}

	public function query($sql) {
		$this->connectToServer();
		$result = $this->mysqliConnection->query($sql);
		$this->close();
		return $result;
	}

	private function close() {
		$this->mysqliConnection->close();
	}

	private function connectToServer() {
		$this->mysqliConnection = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
		$this->selectDB();
		if ($this->mysqliConnection->connect_error) {
			die("Connection failed: " . $this->mysqliConnection->connect_error);
		} else {
			//echo "Connected successfully.";
		}
	}

	private function initializeDB() {
		$sql = "CREATE DATABASE IF NOT EXISTS" . " " . DB_NAME;
		if ($this->mysqliConnection->query($sql) === TRUE) {
			
		} else {
			//echo "Error creating database: " . $this->mysqliConnection->error;
		}
	}

	private function selectDB() {
		if ($this->mysqliConnection->select_db(DB_NAME)) {
			//echo "Connected to DB";
		} else {
			//echo "Couldn't connect to DB";
		}
	}

	private function initializeTables() {
		if ($this->tables != NULL) {
			foreach ($this->tables as $sqlToCreateTable) {
				if ($this->mysqliConnection->query($sqlToCreateTable)) {
					//echo "table created";
				} else {
					//echo "Error creating pricehistory table. " . $this->mysqliConnection->error;
				}
			}
		}
	}
}
?>