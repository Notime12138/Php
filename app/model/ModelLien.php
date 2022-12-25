
<!-- ----- debut ModelLien -->

<?php
require_once 'Model.php';
require_once 'ModelIndividu.php';

class ModelLien {

    private $famille_id, $id, $iid1, $iid2, $lien_type, $lien_date, $lien_lieu;

    public function __construct($famille_id = NULL, $id = NULL, $iid1 = NULL, $iid2 = NULL, $lien_type = NULL, $lien_date = NULL, $lien_lieu = NULL) {
        if (!is_null($famille_id && $id)) {
            $this->famille_id = $famille_id;
            $this->id = $id;
            $this->iid1 = $iid1;
            $this->iid2 = $iid2;
            $this->lien_type = $lient_type;
            $this->lien_date = $lien_date;
            $this->lien_lieu = $lien_lieu;
        }
    }

    public function getFamille_id() {
        return $this->famille_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getIid1() {
        return $this->iid1;
    }

    public function getIid2() {
        return $this->iid2;
    }

    public function getLien_type() {
        return $this->event_type;
    }

    public function getLien_date() {
        return $this->event_date;
    }

    public function getLien_lieu() {
        return $this->event_lieu;
    }

    public function setFamille_id($famille_id) {
        $this->famille_id = $famille_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIid1($iid1) {
        $this->iid1 = $iid1;
    }

    public function setIid2($iid2) {
        $this->iid2 = $iid2;
    }

    public function setLien_type($lien_type) {
        $this->lien_type = $lien_type;
    }

    public function setLien_date($lien_date) {
        $this->lien_date = $lien_date;
    }

    public function setLien_lieu($lien_lieu) {
        $this->lien_lieu = $lien_lieu;
    }

    public static function getAll($famille_id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM `lien` where famille_id = :famille_id";
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

    public static function insert($famille_id, $iid1, $iid2, $type, $date = null, $lieu = null) {
        echo ("<p>inserting!</p> ");
        try {
            $database = Model::getInstance();

            $query = "select max(id) from lien where famille_id = :famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id
            ]);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            if ($id == null) {
                $id = 0;
            }
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into lien value (:famille_id, :id, :iid1, :iid2, :type, :date, :lieu)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $id,
                'iid1' => $iid1,
                'iid2' => $iid2,
                'type' => $type,
                'date' => $date,
                'lieu' => $lieu
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function getOne($famille_id, $id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT famille_id, iid1 as homme_id, iid2 as femme_id, lien_type, lien_date,lien_lieu FROM lien WHERE famille_id = :famille_id and id = :id";
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

    public static function getCouple($famille_id, $iid) {
        try {
            $database = Model::getInstance();
            $sexe = ModelIndividu::getOneSexe($famille_id, $iid);
            if ($sexe == 'H') {
                $query = "SELECT iid2 as iid FROM lien WHERE famille_id = :famille_id and iid1 = :iid AND (lien_type = 'MARIAGE' OR lien_type = 'COUPLE' OR lien_type = 'PACS')";
            } else if ($sexe == 'F') {
                $query = "SELECT iid1 as iid FROM lien WHERE famille_id = :famille_id and iid2 = :iid AND (lien_type = 'MARIAGE' OR lien_type = 'COUPLE' OR lien_type = 'PACS')";
            }
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'iid' => $iid
            ]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

}
?>
<!-- ----- fin ModelLien -->
