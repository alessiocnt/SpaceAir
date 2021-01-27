<?php
//Api to get all the statics for admin
require_once("./AdminLoggedApi.php");

$array["sales"] = $model->getAdminInfoHandler()->getSalesPerPlanet();
$array["popularPacket"] = $model->getAdminInfoHandler()->getPopularPackets();

echo json_encode($array);


?>