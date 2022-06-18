<?php

namespace DogsApp;

class DeleteViewModel extends BaseViewModel {
	public function __construct() {
		parent::__construct();
		$this->deleteDog();
	}

	private function deleteDog() {
		$id = $_GET['id'] ?? 0;

		try {
			$this->pdo->query("DELETE FROM dogs WHERE dog_id = $id");

			header("Location: index.php");
		} catch (\PdoException $e) {
			// log db err
		}
	}
}
