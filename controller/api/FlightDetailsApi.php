<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");
Utils::sec_session_start();

$model = new ModelImpl();
$cartHandler = $model->getCartHandler();

if(isset($_POST["inputQuantity"]) && isset($_POST["packet"])) {
    $qty = $_POST["inputQuantity"];
    $pktId = $_POST["packet"];
    $userId = Utils::getUserId();
    $orderId = $cartHandler->getOrderId($userId)["CodOrder"];
    if(!$orderId) { die(); }
    $res = $cartHandler->addToCart($pktId, $orderId, $qty);
    if(!$res) { die(); }
    header("location: /spaceair/cart.php");
}
?>
