
<!-- ----- debut ModelIndividu -->

<?php
require_once 'Model.php';

class ModelIndividu {

    private $famille_id, $id, $nom, $prenom, $sexe, $pere, $mere;

    public function __construct($famille_id = NULL, $id = NULL, $nom = NULL, $prenom = NULL, $sexe = null, $pere = NULL, $mere = NULL) {
        if (!is_null($famille_id)) {
            $this->famille_id = $famille_id;
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->sexe = $sexe;
            $this->pere = $pere;
            $this->mere = $mere;
        }
    }

    public function getFamille_id() {
        return $this->famille_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getSexe() {
        return $this->sexe;
    }

    public function getPere() {
        return $this->pere;
    }

    public function getMere() {
        return $this->mere;
    }

    public function setFamille_id($famille_id) {
        $this->famille_id = $famille_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setSexe($sexe) {
        $this->sexe = $sexe;
    }

    public function setPere($pere) {
        $this->pere = $pere;
    }

    public function setMere($mere) {
        $this->mere = $mere;
    }

    public static function getAll($famille_id) {
        try {
            $database = Model::getInstance();
            $query = "select * from individu where prenom <> '?' and nom <> '?' and famille_id = :famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getList($famille_id) {
        try {
            $database = Model::getInstance();
            $query = "select * from individu where prenom <> '?' and nom <> '?' and famille_id = :famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id
            ]);
            $datas = $statement->fetchAll(PDO::FETCH_ASSOC);
            $cols = array();
            if (!empty($datas)) {
                $cols = array_keys($datas[0]);
            }
            $results = array($cols, $datas);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getAllSexe($famille_id) {
        try {
            $database = Model::getInstance();
            $query = "select * from individu where prenom <> '?' and nom <> '?' and famille_id = :famille_id and sexe = 'H'";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id
            ]);
            $resultsH = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");

            $query = "select * from individu where prenom <> '?' and nom <> '?' and famille_id = :famille_id and sexe = 'F'";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id
            ]);
            $resultsF = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");

            $results = array($resultsH, $resultsF);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($famille_id, $nom = '?', $prenom = '?', $sexe = '?') {
        try {
            $database = Model::getInstance();
            $query = "select max(id) from individu where famille_id = :famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id
            ]);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            if ($id == null) {
                $id = 0;
            } else {
                $id++;
            }

            // ajout d'un nouveau tuple;
            $query = "insert into individu value (:famille_id, :id, :nom, :prenom, :sexe, 0, 0)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'sexe' => $sexe
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function isExisted($famille_id, $nom, $prenom, $sexe) {
        try {
            $database = Model::getInstance();
            $query = "select id from individu where famille_id = :famille_id and nom = :nom and prenom = :prenom and sexe = :sexe";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'nom' => $nom,
                'prenom' => $prenom,
                'sexe' => $sexe
            ]);
            $result = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $result[0] === null ? false : true;
        } catch (Exception $ex) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function update($famille_id, $parent_id, $enfant_id) {
        try {
            if ($enfant_id === $parent_id) {
                return -1;
            }
            $database = Model::getInstance();
            $sexe = ModelIndividu::getOneSexe($famille_id, $parent_id);
            if ($sexe == 'H') {
                $query = "update individu set pere = :parent_id where famille_id = :famille_id and id = :enfant_id";
            } else if ($sexe == 'F') {
                $query = "update individu set mere = :parent_id where famille_id = :famille_id and id = :enfant_id";
            }
            $statement = $database->prepare($query);
            $statement->execute([
                'parent_id' => $parent_id,
                'famille_id' => $famille_id,
                'enfant_id' => $enfant_id
            ]);
            return array($famille_id, $enfant_id, $parent_id);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function getOneSexe($famille_id, $parent_id) {
        try {
            $database = Model::getInstance();
            $query = "select sexe from individu where famille_id = :famille_id and id = :parent_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'parent_id' => $parent_id
            ]);
            $result = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $result[0];
        } catch (Exception $ex) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function getInd($famille_id, $id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM individu WHERE famille_id = :famille_id and id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results[0];
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getNP($famille_id, $id) {
        try {
            if ($id == 0) {
                $result = '?';
            } else {
                $r = ModelIndividu::getInd($famille_id, $id);
                $result = "<a href=http://dev-isi.utt.fr/~gongziwe/lo07_tds/projet/app/router/router.php?action=indSelected&ind_id=$id target = _blank>" . $r['nom'] . " " . $r['prenom'] . "</a>";
            }
            return $result;
        } catch (Exception $ex) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

//    public static function getEnfant($famille_id, $iid, $couple_id) {
//        try {
//            $database = Model::getInstance();
//            $sexe = ModelIndividu::getOneSexe($famille_id, $iid);
//            if ($sexe == 'H') {
//                $query = "SELECT id,nom,prenom FROM individu WHERE famille_id = :famille_id and id in (SELECT id as enfant_id FROM individu WHERE famille_id = :famille_id and pere = :iid and mere = :c_id)";
//            } else if ($sexe == 'F') {
//                $query = "SELECT id,nom,prenom FROM individu WHERE famille_id = :famille_id and id in (SELECT id as enfant_id FROM individu WHERE famille_id = :famille_id and pere = :c_id and mere = :iid)";
//            }
//            $statement = $database->prepare($query);
//            $statement->execute([
//                'famille_id' => $famille_id,
//                'iid' => $iid,
//                'c_id' => $couple_id
//            ]);
//            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
//            return $results;
//        } catch (PDOException $e) {
//            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
//            return NULL;
//        }
//    }

    public static function getEnfant($famille_id, $iid, $couple_id) {
        try {
            $database = Model::getInstance();
            $sexe = ModelIndividu::getOneSexe($famille_id, $iid);
            if ($sexe == 'H') {
                $query = "SELECT id as enfant_id FROM individu "
                        . "WHERE famille_id = :famille_id and pere = :iid and mere = :c_id";
            } else if ($sexe == 'F') {
                $query = "SELECT id as enfant_id FROM individu "
                        . "WHERE famille_id = :famille_id and pere = :c_id and mere = :iid";
            }
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'iid' => $iid,
                'c_id' => $couple_id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $arr = array();
            for ($i = 0; $i < count($results); $i++) {
                $arr_t = $results[$i];
                $np = ModelIndividu::getNP($famille_id, $results[$i]['enfant_id']);
                array_push($arr_t, $np);
                array_push($arr, $arr_t);
            }
            return $arr;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getUnion($famille_id, $iid, $couple_id) {
        $arr = array();
        for ($i = 0; $i < count($couple_id); $i++) {
            $arr_t = $couple_id[$i];
            $np = ModelIndividu::getNP($famille_id, $couple_id[$i]['iid']);
            array_push($arr_t, $np);
            $enfants = ModelIndividu::getEnfant($famille_id, $iid, $couple_id[$i]['iid']);
            array_push($arr_t, $enfants);
            array_push($arr, $arr_t);
        }
        return $arr;
    }

}
?>
<!-- ----- fin ModelIndividu -->
