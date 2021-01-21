$(document).ready(function() {
    $("img.delete").on("click", function() {
        const addressContainer = $(this).parent().parent().parent();
        const addressId = addressContainer.attr("id");
        
        //Send AJAX request to delete
        $.post("./controller/api/deleteAddressApi.php", {"addressId" : addressId}, function(data){ 
            console.log(data);
            const dataJson = JSON.parse(data);
            if(dataJson["result"]) {
                console.log("OK");
            } else {
                console.log(dataJson["errorMsg"]);
            }
        });

        //Fade out div
        addressContainer.fadeOut();
    });
});