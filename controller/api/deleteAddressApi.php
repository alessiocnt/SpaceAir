<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/controller/api/UserLoggedApi.php");

$result = [];
if(isset($_POST["addressId"])) {    
    if($model->getUserInfoHandler()->deleteAddress(new Address($_POST["addressId"]))) {
        $result["result"] = 1;
    } else {
        $result["result"] = 2;
        $result["errorMsg"] = "Used";    
    }
} else {
    $result["result"] = 0;
    $result["errorMsg"] = "Bad Format";
}

echo json_encode($result);
?>