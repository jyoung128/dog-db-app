<?php 
namespace DogsApp;

class BaseViewModel {
    protected $pdo;

    public function __construct() {
		$this->pdo = self::getPdoConnection();
	}

	private static function getPdoConnection() {
		try {
			$pdoOptions = [ \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION ];
			return new \PDO('mysql:host=localhost;dbname=dogsdb', 'root', '', $pdoOptions);
		} catch (\PdoException $e) {
			// log error
			exit();
		}
	}
}