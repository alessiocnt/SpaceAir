<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class ReviewHandler extends AbstractHandler {

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
    }

    public function getReviewByDestination($planet) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM REVIEW WHERE CodPlanet = ?");
        $planetId = $planet->getCodPlanet();
        $stmt->bind_param("i", $planetId);
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


}

?>