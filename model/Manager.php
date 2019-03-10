<?php
abstract class Manager {
    protected $db;

    public function __construct() {
        $this->dbConnect();
    }

    public function dbConnect() {
        require_once("../config/database.php");
		try {
			$this->db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e) {
			throw new Exception('Connection to database failed: ' . $e->getMessage() . '<br/>');
		}
    }

    public abstract function add($var);
	public abstract function delete($var);
	public abstract function update($var);
	public abstract function get($var);
}