$(document).ready(function() {
    $("img.delete").on("click", function() {
        const addressContainer = $(this).parent().parent().parent();
        const addressId = addressContainer.attr("id");
        $("p.col-error").html("");
        
        //Send AJAX request to delete
        $.post("./controller/api/deleteAddressApi.php", {"addressId" : addressId}, function(data){ 
            const dataJson = JSON.parse(data);
            if(!dataJson["result"]) {
                console.log(dataJson["errorMsg"]);
            } else {
                switch(dataJson["result"]) {
                    case 2:
                        //IMPOSSIBLE REMOVE: Address used in an order
                        $("p.col-error").append(`<span class="font-weight-bold">Impossibile cancellare:</span> indirizzo utilizzato in un ordine.`);
                    break;
                    default:
                        //Ok deleted
                        //Request ok so fade out div
                        addressContainer.slideUp(); 
                    break
                }
            }
        });
    });
});