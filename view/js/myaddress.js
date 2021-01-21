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
                //Request ok so fade out div
                addressContainer.fadeOut();
            }
        });
    });
});