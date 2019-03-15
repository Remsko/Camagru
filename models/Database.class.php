<?php

class Database {
    private static $_dbh;

    private static function setDbh() {
        try {
			require_once('config/database.php');
			$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
			self::$_dbh = new PDO($DB_DSN.';'.$DB_NAME.';charset=utf8', $DB_USER, $DB_PASSWORD, $options);
		}
		catch (PDOException $e) {
			echo 'Connection to database failed: '.$e->getMessage();
			die();
		}
    }

    private static function getDbh() {
		if (!isset(self::$_dbh)) {
			self::setDbh();
		}
		return self::$_dbh;
    }

    public static function safeExecute($query, $values) {
        self::getDbh();
        $stmt = self::$_dbh->prepare($query);
        $stmt->execute($values);
        return $stmt;
    }

    public static function safeExecuteId($query, $values) {
        self::safeExecute($query, $values);
        return self::$_dbh->lastInsertId();
    }

    public static function selectOne($query, $values) {
        if ($stmt = self::safeExecute($query, $values)) {
            return $stmt->fetch();
        }
        return null;
    }

    public static function selectOneObject($query, $values, $object) {
        if ($stmt = self::safeExecute($query, $values)) {
            return $stmt->fetchObject($object);
        }
        return null;
    }

    public static function selectAll($query, $values) {
        $all = [];
        if ($stmt = self::safeExecute($query, $values)) {
            $all = $stmt->fetchAll();
        }
        return $all;
    }

    public static function selectAllObject($query, $values, $object) {
        $all = [];
        if ($stmt = self::safeExecute($query, $values)) {
            $all = $stmt->fetchAll(PDO::FETCH_CLASS, $object);
            $stmt->closeCursor();
        }
		return $all;
	}
}