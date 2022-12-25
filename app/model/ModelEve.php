
<!-- ----- debut ModelEve -->

<?php
require_once 'Model.php';
require_once 'ModelIndividu.php';

class ModelEve {

    private $famille_id, $id, $iid, $event_type, $event_date, $event_lieu;

    public function __construct($famille_id = NULL, $id = NULL, $iid = NULL, $event_type = NULL, $event_date = NULL, $event_lieu = NULL) {
        if (!is_null($famille_id && $id)) {
            $this->famille_id = $famille_id;
            $this->id = $id;
            $this->iid = $iid;
            $this->event_type = $event_type;
            $this->event_date = $event_date;
            $this->event_lieu = $event_lieu;
        }
    }

    public function getFamille_id() {
        return $this->famille_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getIid() {
        return $this->iid;
    }

    public function getEvent_type() {
        return $this->event_type;
    }

    public function getEvent_date() {
        return $this->event_date;
    }

    public function getEvent_lieu() {
        return $this->event_lieu;
    }

    public function setFamille_id($famille_id) {
        $this->famille_id = $famille_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIid($iid) {
        $this->iid = $iid;
    }

    public function setEvent_type($event_type) {
        $this->event_type = $event_type;
    }

    public function setEvent_date($event_date) {
        $this->event_date = $event_date;
    }

    public function setEvent_lieu($event_lieu) {
        $this->event_lieu = $event_lieu;
    }

    public static function getAll($famille_id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM `evenement` where famille_id = :famille_id";
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

    public static function isExisted($famille_id, $iid, $type) {
        try {
            $database = Model::getInstance();
            $query = "select id from evenement where famille_id = :famille_id and iid = :iid and event_type = :type";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'iid' => $iid,
                'type' => $type
            ]);
            $result = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $result[0] === null ? false : true;
        } catch (Exception $ex) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function insert($famille_id, $iid, $type, $date, $lieu) {
        try {
            $database = Model::getInstance();
            $query = "select max(id) from evenement";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            if ($id == null) {
                $id = 0;
            }
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into evenement value (:famille_id, :id, :iid, :type, :date, :lieu)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $id,
                'iid' => $iid,
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

    public static function update($famille_id, $iid, $type, $date, $lieu) {
        try {
            $database = Model::getInstance();
            $query = "update evenement set event_date = :date, event_lieu = :lieu where famille_id = :famille_id and iid = :iid and event_type = :type";
            $statement = $database->prepare($query);
            $statement->execute([
                'date' => $date,
                'lieu' => $lieu,
                'famille_id' => $famille_id,
                'iid' => $iid,
                'type' => $type
            ]);

            // ajout d'un nouveau tuple;
            $query = "select id from evenement where famille_id = :famille_id and iid = :iid and event_type = :type";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'iid' => $iid,
                'type' => $type
            ]);
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $results[0];
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function getOne($famille_id, $id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT famille_id, id as event_id, iid as individu_id, event_type, event_date, event_lieu FROM evenement WHERE famille_id = :famille_id and id = :id";
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

    public static function getEve($famille_id, $iid) {
        try {
            $database = Model::getInstance();
            $query = "SELECT event_date, event_lieu FROM evenement WHERE famille_id = :famille_id and iid = :iid";
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
<!-- ----- fin ModelEve -->
