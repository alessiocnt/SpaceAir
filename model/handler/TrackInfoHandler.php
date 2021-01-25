<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class TrackInfoHandler extends AbstractHandler {

   public function __construct(ModelHelper $model) {
      parent::__construct($model);
   }

   public function addTrackInfo(TrackInfo $trackInfo) {
      $db = $this->getModelHelper()->getDbManager()->getDb();
   }

}