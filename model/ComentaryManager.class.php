<?php
	include ("Db.class.php");

class ComentaryManager {

	public static function add($comentary) {
		$query = 'INSERT INTO comentary(username, contents, date) VALUES(?, ?, ?)';
		$values = array(
			$comentary->getUsernarme(),
			$comentary->getContents(),
			$comentary->getDate()
		);
		Db::execute($query, $values);
	}
}
?>