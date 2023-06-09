<?php 



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
        if($stmt = $db->prepare("SELECT * FROM INTEREST I, PLANET P WHERE I.Visible = true AND P.CodPlanet = I.CodPlanet AND I.IdUser = ?;")) {
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

    public function removeUserInterest(User $user, $planet) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        if(!$stmt = $db->prepare("UPDATE INTEREST SET Visible = 0 WHERE IdUser = ? AND CodPlanet = ?")) {
            return false;
        }
        $userId = $user->getId();
        $codPlanet = $planet->getCodPlanet();
        if(!$stmt->bind_param("ii", $userId, $codPlanet)) {
            return false;
        }
        if(!$stmt->execute()) {
            return false;
        }
        return true;
    }

    public function getAddresses(User $user) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        if($stmt = $db->prepare("SELECT * FROM ADDRESS WHERE IdUser = ? AND Visible = 1;")) {
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
        if($stmt = $db->prepare("INSERT INTO ADDRESS (Via, Civico, Citta, Provincia, Cap, IdUser, Visible) VALUES(?,?,?,?,?,?,1)")) {
            $via = $address->getVia();
            $civico = $address->getCivico();
            $citta = $address->getCitta();
            $provincia = $address->getProvincia();
            $cap = $address->getCap();
            $userId = $address->getUser()->getId();

            $stmt->bind_param('sssssi',$via, $civico, $citta, $provincia, $cap, $userId); 
            if(!$stmt->execute()) {
                return false;
            }

            return true;
        }

        return false;
    }

    public function updateAddress(Address $address) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        if($stmt = $db->prepare("UPDATE ADDRESS SET Via = ?, Civico = ?, Citta = ?, Provincia = ?, Cap = ? WHERE CodAddress = ?;")) {
            $via = $address->getVia();
            $civico = $address->getCivico();
            $citta = $address->getCitta();
            $provincia = $address->getProvincia();
            $cap = $address->getCap();
            $codAddress = $address->getCodAddress();

            $stmt->bind_param('sssssi',$via, $civico, $citta, $provincia, $cap, $codAddress); 
            $stmt->execute();

            return true;
        }

        return false;
    }

    private function isAddressUsed(Address $address) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        if($stmt = $db->prepare("SELECT COUNT(*) AS Conteggio FROM ORDERS WHERE DestAddressCode = ?")) {
            $addressId = $address->getCodAddress();
            if($stmt->bind_param("i", $addressId)) {
                if($stmt->execute()) {
                    $result = $stmt->get_result();
                    $result = $result->fetch_all(MYSQLI_ASSOC)[0];
                    if($result["Conteggio"] == 0) {
                        return false;
                    }
                }
            }
        }
        return true;
    }

    public function deleteAddress(Address $address) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        if(!$this->isAddressUsed($address)) {
            if($stmt = $db->prepare("UPDATE ADDRESS SET Visible = 0 WHERE CodAddress = ?")) {
                $addressId = $address->getCodAddress();
                if($stmt->bind_param("i", $addressId)) {
                    if($stmt->execute()) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function getAddressInfo(Address $address) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        if($stmt = $db->prepare("SELECT * FROM ADDRESS WHERE CodAddress = ? AND Visible = 1 LIMIT 1;")) {
            $addressId = $address->getCodAddress();
            $stmt->bind_param("i", $addressId);
            $stmt->execute();
            $result = $stmt->get_result();
            $result = $result->fetch_all(MYSQLI_ASSOC)[0];
            if(count($result)>0) {
                $addressBuilder = new AddressBuilder();
                return $addressBuilder->createFromAssoc($result);
            }
        }

        return false;
    }
    
    public function existsAddress($address, $userId) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM ADDRESS WHERE Via = ? AND Civico = ? AND Citta = ? AND Provincia = ? AND Cap = ? AND IdUser = ? AND Visible = 1");
        $via = $address->getVia();
        $civico = $address->getCivico();
        $citta = $address->getCitta();
        $provincia = $address->getProvincia();
        $cap = $address->getCap();
        if (!$stmt->bind_param('ssssii', $via, $civico, $citta, $provincia, $cap, $userId)) {
            return false;
        }
        if (!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(count($result) == 0) {
            return false;
        } else {
            return true;
        }
        return false;
    }

    public function getUsersWithNewsletter() {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM USERS WHERE Newsletter = 1");
        if (!$stmt->execute()) {
            return array();
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $users = array();
        if (count($result) == 0) {
            return array();
        } 
        foreach ($result as $res) {
            $builder = new UserBuilder();
            array_push($users, $builder->createFromAssoc($res));
        }
        return $users;
    }

    public function getInterestedUsers($planet) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT IdUser 
        FROM USERS
        WHERE Newsletter = 1
        UNION
        SELECT IdUser
        FROM INTEREST
        WHERE CodPlanet = ?");
        $codPlanet = $planet->getCodPlanet();
        if (!$stmt->bind_param('i', $codPlanet)) {
            return false;
        }
        if (!$stmt->execute()) {
            return array();
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $users = array();
        if (count($result) == 0) {
            return array();
        } 

        $builder = new UserBuilder();
        foreach ($result as $res) {
            array_push($users, $builder->createFromAssoc($res));
        }
        return $users;
    }

    public function getAdmin() {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM USERS WHERE Type = 1");
        if (!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if (count($result) == 0) {
            return false;
        } 

        $builder = new UserBuilder();
        return $builder->createFromAssoc($result[0]);
    }

}

?>