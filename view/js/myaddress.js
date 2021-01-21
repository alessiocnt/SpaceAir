$(document).ready(function() {
    $("img.delete").on("click", function() {
        const addressContainer = $(this).parent().parent().parent();
        const addressId = addressContainer.attr("id");
        
        //Send AJAX request to delete

        //Fade out div
    });
});