<?php

class Db {
	private static $_instance = null;

	public function getInstance() {
		if (!isset(self::$_instance)) {
			try {
				require_once('config/database.php');
				$options  = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
				self::$_instance = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
			}
			catch (PDOException $e) {
				echo 'Connection to database failed: ' . $e->getMessage();
				die();
			}
		}
		return self::$_instance;
	}

	public static function query($query) {
		self::get();
		$stmt = self::$_instance->query($query);
		return $stmt;
	}

	public static function execute($sql, $values) {
		self::get();
		$stmt = self::$_instance->prepare($sql);
		$stmt->execute($values);
		return $stmt;
	}

	public static function insert($sql, $values) {
		self::get();
		self::prepare($sql, $values);
		return self::$_instance->lastInsertId();
	}

	public static function select($sql, $values) {
		self::get();
		return self::execute($sql, $values);
	}

	public static function selectOne($sql, $values) {
		self::get();
		if ($stmt = self::prepare($sql, $values))
			return $stmt->fetch();
		return false;
	}

	public static function selectOneObject($sql, $values, $object) {
		self::get();
		if ($stmt = self::prepare($sql, $values))
			return $stmt->fetchObject($object);
		return false;
	}

	public static function selectAll($sql, $values) {
		self::get();
		if ($stmt = self::prepare($sql, $values))
			return $stmt->fetchAll();
		return false;
	}

	public static function selectAllObject($sql, $values, $object) {
		self::get();
		if ($stmt = self::prepare($sql, $values))
			return $stmt->fetchAll(PDO::FETCH_CLASS, $object);
		return false;
	}
}

?>
