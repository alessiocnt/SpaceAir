<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class TrackInfoHandler extends AbstractHandler {

   public function __construct(ModelHelper $model) {
      parent::__construct($model);
   }

   public function addTrackInfo(TrackInfo $trackInfo) {
      $db = $this->getModelHelper()->getDbManager()->getDb();

      if($stmt = $db->prepare("INSERT INTO TRACK (CodOrder, DateTime, City, Description) VALUES (?, ?, ?, ?);")) {
         $codOrder = $trackInfo->getOrder()->getCodOrder();
         $dateTime = $trackInfo->getDate()->format("Y-m-d H:i:s");
         $description = $trackInfo->getDescription();
         $city = $trackInfo->getCity();

         $stmt->bind_param('isss', $codOrder, $dateTime, $city, $description);
         if($stmt->execute()) {
            return true;
         }
      }

      return false;
   }

}