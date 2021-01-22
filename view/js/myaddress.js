$(document).ready(function() {
    $("img.delete").on("click", function() {
        const addressContainer = $(this).parent().parent().parent();
        const addressId = addressContainer.attr("id");
        
        //Send AJAX request to delete
        $.post("./controller/api/deleteAddressApi.php", {"addressId" : addressId}, function(data){ 
            const dataJson = JSON.parse(data);
            if(!dataJson["result"]) {
                console.log(dataJson["errorMsg"]);
            } else {
                switch(dataJson["result"]) {
                    case 2:
                        //IMPOSSIBLE REMOVE: Address used in an order
                        $("p.col-error").removeClass("d-none");
                    break;
                    default:
                        //Ok deleted
                        //Request ok so fade out div
                        addressContainer.slideUp(); 
                        if(!$("p.col-error").hasClass("d-none")) {
                            $("p.col-error").addClass("d-none");
                        }
                    break
                }
            }
        });
    });
});