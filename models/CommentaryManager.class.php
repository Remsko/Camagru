<?php
	include ("Database.class.php");

class CommentaryManager {

	public function add($commentary) {
		$query = 'INSERT INTO commentary(username, contents, date) VALUES(?, ?, ?)';
		$values = array(
			$commentary->getUsernarme(),
			$commentary->getContents(),
			$commentary->getDate()
		);
		$result = Db::execute($query, $values);
		return $result;
	}

	public function delete ($commentary) {
		$id = $commentary->getId();
		$result =  Db::update('DELETE FROM commentary WHERE id =?', [$id]);
		return $result;
	}

	public function get($commentary) {
		$id = $commentary->getId();
		return Db::selectOne('SELECT * FROM commentary WHERE id =?', [$id]);
	}
}
?>