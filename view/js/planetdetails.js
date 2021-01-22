$(document).ready(function () {
    $('#newReview').submit(function (e) {
        e.preventDefault();
        
        let posting = $.post("/spaceair/controller/api/AddReviewApi.php/", {
            Titolo: $("#inputTitle").val(),
            Valutazione: $("#inputQuantity").val(),
            Descrizione: $("#inputReview").val(),
            Pianeta: $("#inputPlanet").val(),
        });
        /* Alerts the results */
        posting.done(function (data) {
            $('#reviewResult').text(data);
        });
        
    });
/* 
    $('#formPayment').submit(function (e) {
        e.preventDefault();
        $('#paymentResult').text('Complimenti hai acquistato utilizzando ' + metod);
        setTimeout(function(){ 
            window.location.replace("/spaceair/homepage.php");
        }, 1500);
    }); */
});