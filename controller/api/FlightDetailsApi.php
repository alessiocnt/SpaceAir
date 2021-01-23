<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/controller/api/UserLoggedApi.php");

$model = new ModelImpl();
$cartHandler = $model->getCartHandler();

if(isset($_POST["inputQuantity"]) && isset($_POST["packet"])) {
    $qty = $_POST["inputQuantity"];
    $pktId = $_POST["packet"];
    $userId = Utils::getUserId();
    $orderId = $cartHandler->getOrderId($userId);
    if(!is_int($orderId) && !is_bool($orderId)) {
        $orderId = $orderId["CodOrder"];
    }
    if(!$orderId) { die(); }
    $res = $cartHandler->addToCart($pktId, $orderId, $qty);
    if(!$res) { die(); }
    header("location: /spaceair/cart.php");
}
?>
