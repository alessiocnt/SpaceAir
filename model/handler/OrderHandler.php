<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class OrderHandler extends AbstractHandler {

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
    }


    public function getOrderById($id) {
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

    public function purchaseOrder($order, $user, $total) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("UPDATE ORDERS SET PurchaseDate = NOW(), DestAddressCode = ?, State = 1, Total = ? WHERE CodOrder = ? AND IdUser = ?");
        $address = $user->getAddresses()[0]->getCodAddress();
        $userId = $user->getId();
        $codOrder = $order->getCodOrder();
        if(!$stmt->bind_param("iiii", $address, $total,  $codOrder, $userId)) {
            return false;
        }
        if(!$stmt->execute()) {
            return false;
        }
        return true;
    }

    public function checkAvailable($order) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT COUNT(*) AS tot
        FROM 
        (SELECT P.CodPacket AS CodPacketOrd, P.MaxSeats AS MaxSeatsOrd, PIO.Quantity AS QuantityOrd
        FROM PACKET P JOIN PACKET_IN_ORDER PIO ON P.CodPacket = PIO.CodPacket
        WHERE PIO.CodOrder = ? ) PORD 
        JOIN
        (SELECT SUM(PIO.Quantity) AS Venduti, P.CodPacket as CodPacketVend
        FROM PACKET_IN_ORDER PIO JOIN ORDERS O ON PIO.CodOrder = O.CodOrder JOIN PACKET P ON P.CodPacket = PIO.CodPacket
        WHERE O.PurchaseDate IS NOT NULL
        GROUP BY P.CodPacket) PVEND
        ON PORD.CodPacketOrd = PVEND.CodPacketVend
        WHERE PVEND.Venduti + PORD.QuantityOrd > PORD.MaxSeatsOrd");
        $codOrder = $order->getCodOrder();
        if(!$stmt->bind_param("i", $codOrder)) {
            return false;
        }
        if(!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result();
        $result->fetch_all(MYSQLI_ASSOC);
        foreach ($result as $res) {
            if($res["tot"] == 0) {
                return true;
            }
            return false;
        }
        
    }

}

?>