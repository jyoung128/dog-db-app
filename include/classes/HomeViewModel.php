<?php 
namespace DogsApp;

class HomeViewModel extends BaseViewModel {
    public $dogs;

    public function __construct() {
		parent::__construct();
		$this->getDogs();
	}

	private function getDogs() {
		try {
			$sql = "SELECT d.dog_id, d.dog_name, b.breed_name, d.age, d.is_fixed, d.is_vaccinated
				FROM dogs d
				JOIN breeds b ON d.breed_id = b.breed_id
				ORDER BY dog_name";
			$this->dogs = $this->pdo->query($sql);
		} catch (\PdoException $e) {
			// log error
		}
	}

}