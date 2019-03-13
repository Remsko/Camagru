<?php

abstract class Manager {
    protected $_db;

    public function dbConnect() {
        require_once('config/database.php');
		try {
			$this->_db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e) {
			throw new Exception('Connection to database failed: ' . $e->getMessage());
		}
    }

    public abstract function add($var);
	public abstract function delete($var);
	public abstract function update($var);
	public abstract function get($var);
}

?>