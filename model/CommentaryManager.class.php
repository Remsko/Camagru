<?php
	include ("Db.class.php");

class CommentaryManager {

	public static function add($commentary) {
		$query = 'INSERT INTO commentary(username, contents, date) VALUES(?, ?, ?)';
		$values = array(
			$commentary->getUsernarme(),
			$commentary->getContents(),
			$commentary->getDate()
		);
		Db::execute($query, $values);
	}
}
?>