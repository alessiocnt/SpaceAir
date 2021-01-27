<?php
require_once("./autoloader.php");

Utils::sec_session_start();

$model = new ModelImpl();
if(!$model->getUserHandler()->checkLogin(UserHandler::$LOGINOKUSER)) {
    header("location: ../../login.php");
}

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
    header("location: ../../cart.php");
}
?>
