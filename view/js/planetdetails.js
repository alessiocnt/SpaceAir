$(document).ready(function () {
    // Invio una nuova recensione
    $('#newReview').submit(function (e) {
        e.preventDefault();
        let posting = $.post("/spaceair/controller/api/AddReviewApi.php/", {
            Titolo: $("#inputTitle").val(),
            Valutazione: $("#inputStars").val(),
            Descrizione: $("#inputReview").val(),
            Pianeta: $("#inputPlanet").val(),
        });
        /* Descrive il risultato a schermo */
        posting.done(function (data) {
            $('#reviewResult').text(data);
        });
        $("#inputTitle").val("");
        $("#inputStars").val("");
        $("#inputReview").val("");
    });
});