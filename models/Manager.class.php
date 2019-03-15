<?php

abstract class Manager {
    private static $_db;

    private static function setDb() {
		try {
			require_once('config/database.php');
			$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
			self::$_db = new PDO($DB_DSN.';'.$DB_NAME.';charset=utf8', $DB_USER, $DB_PASSWORD, $options);
		}
		catch (PDOException $e) {
			echo 'Connection to database failed: '.$e->getMessage();
			die();
		}
	}
	
	protected function getDb() {
		if (!isset(self::$_db)) {
			self::setDb();
		}
		return self::$_db;
	}

	protected function getAll($table, $obj) {
		$this->getDb();
		$var = [];
		$req = self::$_db->prepare('SELECT * FROM '.$table.' ORDER BY id desc');
		$req->execute();
		while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
			$var[] = new $obj($data);
		}
		return $var;
		$req->closeCursor();
	}

    public abstract function add($var);
	public abstract function delete($var);
	public abstract function update($var);
	public abstract function get($var);
}

?>