<?php

class Image {
		private $_id;
		private	$_username;
		private	$_name;
		private	$_type;
		private	$_descrip;
		private	$_blob;

		public function __construct(array $donnees) {
			$this->hydrate($donnees);
		}
		
		public function hydrate(array $donnees) {
			foreach ($donnees as $key => $value) {
				$method = 'set'.ucfirst($key);
				if (method_exists($this, $method)) {
					$this->$method($value);
				}
			}
		}

		public function getId() {
			return $this->_id;
		}

		public function getName() {
			return $this->_name;
		}

		public function getUsername() {
			return $this->_username;
		}

		public function getType() {
			return $this->_type;
		}

		public function getDescrip() {
			return $this->_descrip;
		}

		public function getBlob() {
			return $this->_blob;
		}

		public function setId($id) {
			if (is_int($id)) {
				$this->_id = $id;
			}
		}

		public function setName($name) {
			if (is_string($name)){
				$this->_name = $name;
			}
		}

		public function setUsername($username) {
			if (is_string($username)){
				$this->_username = $username;
			}	
		}
		
		public function setType($type) {
			$extensions = array('/png', '/jpg', '/jpeg');
			$extension = strrchr($type, '/');
			if(!in_array($extension, $extensions)) {
				echo 'Wrong file type. You can only upload png jpg or jpeg files.';
			}
			else {
				$this->_type = $type;
			}
		}

		public function setDescrip($descrip) {
			if (is_string($descrip)) {
				$this->_descrip = $descrip;
			}
		}

		public function setBlob($path) {
			$blob = file_get_contents($path);
			$this->_blob = $blob;
		}
}

?>
