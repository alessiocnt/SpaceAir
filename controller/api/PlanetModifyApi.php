<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/controller/api/AdminLoggedApi.php");

$planetHandler = $model->getPlanetHandler();

if(isset($_POST["inputName"])) {
    $data["Name"] = $_POST["inputName"];
    $data["Temperature"] = $_POST["inputTemperature"];
    $data["SunDistance"] = $_POST["inputSunDistance"];
    $data["Mass"] = $_POST["inputMass"];
    $data["Surface"] = $_POST["inputSurface"];
    $data["Composition"] = $_POST["inputComposition"];
    $data["DayLength"] = $_POST["inputDay"];
    $data["Description"] = $_POST["inputDescription"];
    $data["Visible"] = isset($_POST["inputVisible"]) ? 1 : 0;
    if($_FILES["img"]["name"] != "") {
        $data["Img"] = $_FILES["img"];
    }
    $oldPlanet = $planetHandler->searchPlanetByCod($_POST["old-planet"])[0];
    $builder = new PlanetBuilder();
    $planet = $builder->createFromAssoc($data);

    $planetHandler->updatePlanet($planet, $oldPlanet);
    header("location: /spaceair/destinationsadmin.php");
}
?>
