<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class UserInfoHandler extends AbstractHandler {

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
    }

    public function getUserInfo(User $user) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        if($stmt = $db->prepare("SELECT * from USERS where IdUser = ? LIMIT 1;")) {
            $userId = $user->getId();
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $result = $result->fetch_all(MYSQLI_ASSOC);

            $builder = new UserBuilder();
            return $builder->createFromAssoc($result[0]);
        }
    }

    public function getUserInterest(User $user) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        if($stmt = $db->prepare("SELECT * FROM INTEREST I, PLANET P WHERE P.CodPlanet = I.CodPlanet AND I.IdUser = ?;")) {
            $userId = $user->getId();
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $results = $stmt->get_result();
            $results = $results->fetch_all(MYSQLI_ASSOC);
            
            $planetBuilder = new PlanetBuilder();
            $interestBuilder = new InterestBuilder();
            $array = array();
            foreach($results as $result) {
                $interest = $interestBuilder->createFromAssoc($result);
                $planet = $planetBuilder->createFromAssoc($result);
                $interest->setPlanet($planet);
                array_push($array, $interest);
            }

            return $array;
        }

        return array();
    }

    public function getAddresses(User $user) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        if($stmt = $db->prepare("SELECT * FROM ADDRESS WHERE IdUser = ?;")) {
            $userId = $user->getId();
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $results = $stmt->get_result();
            $results = $results->fetch_all(MYSQLI_ASSOC);

            $addressBuilder = new AddressBuilder();
            $array = array();
            foreach($results as $result) {
                $address = $addressBuilder->createFromAssoc($result);
                array_push($array, $address);
            }

            return $array;
        }

        return array();
    }

    public function addAddress(Address $address) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        if($stmt = $db->prepare("INSERT INTO ADDRESS (Via, Civico, Citta, Provincia, Cap, IdUser) VALUES(?,?,?,?,?,?)")) {
            $via = $address->getVia();
            $civico = $address->getCivico();
            $citta = $address->getCitta();
            $provincia = $address->getProvincia();
            $cap = $address->getCap();
            $userId = $address->getUser()->getId();

            $stmt->bind_param('sssssi',$via, $civico, $citta, $provincia, $cap, $userId); 
            $stmt->execute();

            return true;
        }

        return false;
    }

    public function deleteAddress(Address $address) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        if($stmt = $db->prepare("DELETE FROM `ADDRESS` WHERE `ADDRESS`.`CodAddress` = ?")) {
            $addressId = $address->getCodAddress();
            if($stmt->bind_param("i", $addressId)) {
                if($stmt->execute()) {
                    return true;
                }
            }
        }
        return false;
    }
}

?>