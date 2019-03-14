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
		$result = Db::execute($query, $values);
		return $result;
	}

	public static function delete ($commentary) {
		$id = $commentary->getId();
		$result =  Db::update('DELETE FROM commentary WHERE id =?', [$id]);
		return $result;
	}
	public static function update($commentary) {

	}
}
?>