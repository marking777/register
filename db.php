<?php
class Database{
    public $pdo;
    private string $MyTable = "ewa";

    public function __construct($db = "ostia1", $user ="root", $pwd="", $host="localhost:3307") {

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully $db";
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }

    }

    public function insertUser(string $email, String $password) : string | false {
        $stmt = $this->pdo->prepare("INSERT INTO $this->MyTable (email, password) values (?, ?)");
        $stmt->execute([$email, $password]);
        return $this->pdo->lastInsertId();
    }

    public function select(){
        $stmt = $this->pdo->query("SELECT * FROM ewa");
        $resultaat = $stmt->fetchAll();
        return $resultaat;
    }

    public function selectOneUser($id) : array {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->MyTable WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function selectAllUsers() : array {
        $stmt = $this->pdo->query("SELECT * FROM $this->MyTable");
        $result = $stmt->fetchAll();
        return $result; 
    }
   
    public function updateUser(string $email, String $password, int $id) {
        $stmt = $this->pdo->prepare("UPDATE $this->MyTable SET email = ?, password = ? 
        WHERE id = ?");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([$email, $password, $id]);
    }

    public function deleteUser(int $id) {
        $stmt = $this->pdo->prepare("DELETE from $this->MyTable WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function registreren($naam, $achternaam, $geboortedatum, $email, $password) {
        $stmt = $this->pdo->prepare("INSERT INTO $this->MyTable (naam,achternaam,geboortedatum,email,password) values (?,?,?,?,?)");
        $stmt->execute([$naam, $achternaam, $geboortedatum, $email, $password]);
    }
    
}                        
?>