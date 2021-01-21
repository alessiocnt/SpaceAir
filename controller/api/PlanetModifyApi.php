<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");
Utils::sec_session_start();

$model = new ModelImpl();
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
    $data["Visible"] = isset($_POST["inputVisible"]);
    if(isset($_FILES["img"])) {
        $data["Img"] = $_FILES["img"];
    }
    $builder = new PlanetBuilder();
    $planet = $builder->createFromAssoc($data);
    $oldPlanet = $_POST["old-planet"];

    $planetHandler->updatePlanet($planet, $oldPlanet);
    header("location: /spaceair/destinations.php");
}
?>
