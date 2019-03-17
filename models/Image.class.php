<?php

class Image {
		private $_id;
		private $_userId;
		private $_path;

		public function __construct(array $data) {
			$this->hydrate($data);
		}
		
		public function hydrate(array $data) {
			foreach ($data as $key => $value) {
				$method = 'set'.ucfirst($key);
				if (method_exists($this, $method)) {
					$this->$method($value);
				}
			}
		}

		public function getId() {
			return $this->_id;
		}

		public function getUserId() {
			return $this->_userId;
		}

		public function getPath() {
			return $this->_path;
		}

		public function setId($id) {
			if (is_int($id)) {
				$this->_id = $id;
			}
		}

		public function setUserId($userId) {
			if (is_int($userId)) {
				$this->_userId = $userId;
			}
		}

		public function setPath($path) {
			if (is_string($path)) {
				$this->_path = $path;
			}
		}
}

?>
