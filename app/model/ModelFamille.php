
<!-- ----- debut ModelFamille -->

<?php
require_once 'Model.php';

class ModelFamille {

    private $id, $nom;

    // pas possible d'avoir 2 constructeurs
    public function __construct($id = NULL, $nom = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
        }
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "select * from famille";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelFamille");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($nom) {
        try {
            $database = Model::getInstance();
            $query = "select max(id) from famille";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            if ($tuple == null) {
                $id = 0;
            }
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into famille value (:id, :nom)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'nom' => $nom
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function getAllName() {
        try {
            $database = Model::getInstance();
            $query = "select nom from famille";
            $statement = $database->query($query);
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $results;
        } catch (Exception $ex) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getOne($nom) {
        try {
            $database = Model::getInstance();
            $query = "select * from famille where nom = :nom";
            $statement = $database->prepare($query);
            $statement->execute([
                'nom' => $nom
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelFamille");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getOneId($nom) {
        try {
            $database = Model::getInstance();
            $query = "select id from famille where nom = :nom";
            $statement = $database->prepare($query);
            $statement->execute([
                'nom' => $nom
            ]);
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $results[0];
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

}
?>
<!-- ----- fin ModelFamille -->
