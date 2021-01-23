<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class ReviewHandler extends AbstractHandler {

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
    }

    public function getRandomReview($planet, $n) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM REVIEW WHERE CodPlanet = ? ORDER BY RAND() LIMIT ?");
        $planetId = $planet->getCodPlanet();
        $stmt->bind_param("ii", $planetId, $n);
        $stmt->execute();
        $result = $stmt->get_result();
        $result->fetch_all(MYSQLI_ASSOC);

        $builder = new ReviewBuilder();
        $reviews = array();
        foreach ($result as $rev) {
            array_push($reviews,$builder->createFromAssoc($rev));
        }
        return $reviews;
    }

    public function addReview($review) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        if($stmt = $db->prepare("INSERT INTO REVIEW (DateTime, Title, Description, Rating, IdUser, CodPlanet) VALUES(?,?,?,?,?,?)")) {
            $date = $review->getDateTime()->format("Y-m-d H:i:s");
            $title = $review->getTitle();
            $description = $review->getDescription();
            $stars = $review->getRating();
            $idUser = $review->getIdUser();
            $idPlanet = $review->getCodPlanet();
            if(!$stmt->bind_param('sssiii',$date, $title, $description, $stars, $idUser, $idPlanet)){
                return false;
            }
            if(!$stmt->execute()) {
                return false;
            }
            return true;
        }
        return false;
    }

}

?>