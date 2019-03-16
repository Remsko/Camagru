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
        if ($stmt = self::$_dbh->prepare($query)) {
            $stmt->execute($values);
        }
        return $stmt;
    }

    public static function safeExecuteId($query, $values) {
        self::safeExecute($query, $values);
        return self::$_dbh->lastInsertId();
    }

    public static function selectOne($query, $values) {
        $one = null;
        if ($stmt = self::safeExecute($query, $values)) {
            $one = $stmt->fetch();
            $stmt->closeCursor();
        }
        return $one;
    }

    public static function selectOneObject($query, $values, $object) {
        $one = null;
        if ($stmt = self::safeExecute($query, $values)) {
            if ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $one = new $object($data);
            }
            $stmt->closeCursor();
        }
        return $one;
    }

    public static function selectAll($query, $values) {
        $all = [];
        if ($stmt = self::safeExecute($query, $values)) {
            $all = $stmt->fetchAll();
            $stmt->closeCursor();
        }
        return $all;
    }

    public static function selectAllObject($query, $values, $object) {
        $all = [];
        if ($stmt = self::safeExecute($query, $values)) {
            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $all[] = new $object($data);
            }
            $stmt->closeCursor();
        }
		return $all;
	}
}