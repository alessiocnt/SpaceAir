$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: '/spaceair/controller/api/CartApi.php',
        dataType: 'json',
        success:function(data) {
            console.log(data.data);
        },
        error:function(data) {
            console.log(data);
        }
    });
}); 

/*
<div class="row ml-1 mr-1">
    <div class="col-12 col-md-6 offset-md-3 p-0">
        <div class="rounded my-2 col-back-white p-4 col-dark ">
            <div class="row">
                <div class="col-4 col-md-3">
                    <img src="/spaceair/res/img/mars.png" class="card-img" alt="">
                </div>
                <div class="col-8 col-md-9">
                    <a href="" title="Rimuovi dal carrello">
                        <img src="/spaceair/res/icons/remove_shopping_cart-black-18dp.svg" class="mw-25 float-right md-1" alt="Rimuovi dal carrello">
                    </a>
                    <p class="my-0 text-uppercase font-weight-bold list-impo-text">Viaggio verso Marte</p>
                    <p>20.11.2021 - 14:46</p>
                    <p class="text-uppercase my-0">Andrea Giulianelli</p>
                    <p class="font-weight-normal my-0">15.03.2021</p>
                    <p id="price1" class="font-weight-normal my-0 float-right bottom mr-md-1 mt-4">Costo €9200</p>
                    <label for="inputQuantity1" class="invisible custom-file-label">Quantità prodotto</label>
                    <div class="input-group col-4 col-md-2 pl-0">
                        <input type="number" class="form-control font-weight-normal my-0 float-left bottom mr-1 mt-3" name="inputQuantity1" id="inputQuantity1" value="2" min="1" max="10" step="1" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");


class CartHandler extends AbstractHandler {

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
    }

    public function getCart() {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT PACKET.*, PACKET_IN_ORDER.Quantity
        FROM PACKET JOIN PACKET_IN_ORDER ON PACKET.CodPacket = PACKET_IN_ORDER.CodPacket JOIN ORDERS ON ORDERS.CodOrder = PACKET_IN_ORDER.CodOrder
        WHERE ORDERS.PurchaseDate IS NULL AND ORDERS.IdUser = ?");
        $stmt->bind_param('i', $_SESSION["user_id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $result->fetch_all(MYSQLI_ASSOC);
        
        $packets = array();
        foreach ($result as $packet) {
            $packet["unitPrice"] = $packet["Price"] / $packet["Quantity"];
            array_push($packets, $packet);
        }
        return json_encode($packets);
    }


}

?>
*/