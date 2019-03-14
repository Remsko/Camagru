<?php

class ImageManager extends Manager {

	public function getImages() {
		$this->getAll('images', 'Image');
	}
	
	public	function add($img) {
		$query = $this->_db->prepare('INSERT INTO images(name, username, type, descrip, img_blob) VALUES(:name, :username, :type, :descrip, :img_blob)');

		if (!$query->bindValue(':name', $img->getName()))
			throw new Exception('Name Input Error');
		if (!$query->bindValue(':username', $img->getUsername()))
			throw new Exception('Username Input Error');
		if (!$query->bindValue(':type', $img->getType()))
			throw new Exception('Type Input Error');
		if (!$query->bindValue(':descrip', $img->getDescrip()))
			throw new Exception('Description Input Error');
		if (!$query->bindValue(':img_blob', $img->getBlob()))
			throw new Exception('Blob Input Error');
		$query->execute();
	}

	public function delete($img) {
		$query = $this->_db->prepare('DELETE FROM Images WHERE name = :name');
		if (!$query->bindvalue(':name', $img->getName()))
			throw new Exception('Name Input Error');
		$query->execute();
	}

	public function update($img)
	{
		$query = $this->_db->prepare('UPDATE Images SET name = :name, username = :username,blob = :blob, description = :description WHERE name = :name');

		if (!$query->bindValue(':name', $img->getName()))
			throw new Exception('Name Input Error');
		if (!$query->bindValue(':username', $img->getUsername()))
			throw new Exception('Username Input Error');
		if (!$query->bindValue(':type', $img->getType()))
			throw new Exception('Type Input Error');
		if (!$query->bindValue(':description', $img->getDescrip()))
			throw new Exception('Description Input Error');
		if (!$query->bindValue(':blob', $img->getBlob()))
			throw new Exception('Blob Input Error');
		$query->execute();
	}

	public function get($img) {
		$query = $this->_db->prepare('SELECT username, type, descrip FROM Images WHERE name = :name');
		if ($query->bindValue(':name', is_int($img->getName())))
			throw new Exception('Name Input Error');
		$query->execute();
		$data = $query->fetch(PDO::FETCH_ASSOC);

		return new Image($data);
	}
}

?>
