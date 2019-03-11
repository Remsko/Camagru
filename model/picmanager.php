<?php
	include("users.php");

class ImageManager extends Manager {
		
	public function __construct() {
		try {
			$this->_db = $this->dbConnect();
		}
		catch (Exception $e) {
			throw $e;
		}
	}
	public	function add($img)
{
	$q = $this->_db->prepare('INSERT INTO images(name, username, type, descrip, img_blob) VALUES(:name, :username, :type, :descrip, :img_blob)');

	if (!$q->bindValue(':name', $img->name()))
		throw new Exception('Name Input Error');
	if (!$q->bindValue(':username', $img->username()))
		throw new Exception('Username Input Error');
	if (!$q->bindValue(':type', $img->type()))
		throw new Exception('Type Input Error');
	if (!$q->bindValue(':descrip', $img->descrip()))
		throw new Exception('Descrip Input Error');
	if (!$q->bindValue(':img_blob', $img->blob()))
		throw new Exception('Blob Input Error');
	$q->execute();
}

public function delete($img)
{
	$q = $this->_db->prepare('DELETE FROM Images WHERE name = :name');
	if (!$q->bindvalue(':name', $img->name()))
		throw new Exception('Blob Input Error');
	$q->execute();
}

public function update($img)
{
	$q = $this->_db->prepare('UPDATE Images SET name = :name, username = :username,blob = :blob, description = :description WHERE name = :name');

	if (!$q->bindValue(':name', $img->name()))
		throw new Exception('Name Input Error');
	if (!$q->bindValue(':username', $img->username()))
		throw new Exception('Username Input Error');
	if (!$q->bindValue(':type', $img->type()))
		throw new Exception('Type Input Error');
	if (!$q->bindValue(':description', $img->descrip()))
		throw new Exception('Description Input Error');
	if (!$q->bindValue(':blob', $img->blob()))
		throw new Exception('Blob Input Error');
	$q->execute();
}

public function get($img)
{
	$query = $this->_db->prepare('SELECT username, type, descrip FROM Images WHERE name = :name');
	if ($query->bindValue(':name', is_int($images->name())))
		throw new Exception('Name Input Error');
	$query->execute();
	$donnees = $query->fetch(PDO::FETCH_ASSOC);

	return new Image($donnees);
}
}

?>