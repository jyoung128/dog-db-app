<?php 
namespace DogsApp;

class FormViewModel extends BaseViewModel{
    public $breeds;
    public $errors = [];
    public $dog;

    public function __construct(){
        parent::__construct();
        $this->getBreeds();
        $this->handleSubmit();
        $this->getDog();

    }

    private function getDog(){
        if (!isset($_GET['id'])) {
            return;
        }

        $id = $_GET['id'];

        try {
            $result = $this->pdo->query("SELECT * FROM dogs WHERE dog_id = $id");

            if ($result->rowCount() === 1) {
                $this->dog = $result->fetchObject();
            }

        } catch (\PdoException $e) {
            //throw err;
        }
    }

    private function getBreeds(){
        try {
            $this->breeds = $this->pdo->query("SELECT * FROM breeds ORDER BY breed_name");
        } catch (\PdoException $e) {
            //log err;
        }
    }

    private function handleSubmit(){
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        try {
            $id = $_POST['dog_id'];
            $name = $_POST['dog_name'];
            $breed = $_POST['breed_name'];
            $age = $_POST['age'];
            $fixed = isset($_POST['is_fixed']) ? 1 : 0;
            $vaccinated = isset($_POST['is_vaccinated']) ? 1 : 0;

            if(empty($name) || empty($breed) || empty($age)){
                array_push($this->errors, "Please enter a name, breed, and age.");
            }

            if(!is_numeric($age)){
                array_push($this->errors, "Please enter a valid age");
            }

            if(count($this->errors) > 0){
                throw new \Exception("Invalid user input");   
            }

            if (is_numeric($id)) {
                $sql = "UPDATE dogs set dog_name='$name', breed_id=$breed, age='$age',
                is_fixed=$fixed, is_vaccinated=$vaccinated WHERE dog_id = $id";
            } else {
                $sql = "INSERT INTO dogs(dog_name, breed_id, age, is_fixed, is_vaccinated)
                    VALUES('$name', $breed, '$age', $fixed, $vaccinated)";
            }

            $this->pdo->query($sql);
            header("Location: index.php");

        } catch(\PdoException $e){
            //log possible err for db query
            print $e->getMessage();
            return;
        } catch (\Exception $e) {
            //log err;
            return;
        }
    }
}