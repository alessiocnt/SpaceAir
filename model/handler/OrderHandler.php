<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class OrderHandler extends AbstractHandler {

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
    }


    public function getOrderById($id) {
        echo 'Dentro';
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT CodOrder FROM ORDERS WHERE CodOrder = ?");
        if(!$stmt->bind_param("i", $id)) {
            return false;
        }
        if(!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result();
        $result->fetch_all(MYSQLI_ASSOC);
        $builder = new OrderBuilder();
        foreach ($result as $val) {
            return $builder->createFromAssoc($val);
        }
    }

    public function purchaseOrder($order, $user) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("UPDATE ORDERS SET PurchaseDate = NOW(), DestAddressCode = ?, State = 1 WHERE CodOrder = ? AND IdUser = ?");
        $address = $user->getAddresses()[0]->getCodAddress();
        $userId = $user->getId();
        $codOrder = $order->getCodOrder();
        if(!$stmt->bind_param("iii", $address, $codOrder, $userId)) {
            return false;
        }
        if(!$stmt->execute()) {
            return false;
        }
        return true;
    }

}

?>