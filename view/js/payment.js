$(document).ready(function () {
    const tot = $('p#tot').text().split('€')[1];
    let metod = null;
    $('article#card').hide();
    const cred = $('a#cred');
    const paypal = $('a#paypal');

    $('a#cred').click(function (e) {
        e.preventDefault();
        $('article#card').slideDown();
        metod = 'cred';
        $('input#acq').prop('disabled', false);
    });

    $('a#paypal').click(function (e) {
        e.preventDefault();
        $('article#card').slideUp();
        metod = 'paypal';
        $('input#acq').prop('disabled', false);
    });

    $('#formAddr').submit(function (e) {
        e.preventDefault();
        
        let posting = $.post("/spaceair/controller/api/AddAddressApi.php/", {
            Via: $("#inputVia").val(),
            Civico: $("#inputCivico").val(),
            Citta: $("#inputCitta").val(),
            Provincia: $("#inputProvincia").val(),
            Cap: $("#inputCap").val()
        });
        /* Alerts the results */
        posting.done(function (data) {
            $('#changeAddressResult').text(data);
        });
        
    });

    $('#formPayment').submit(function (e) {
        e.preventDefault();
        $('#paymentResult').text('Complimenti hai acquistato utilizzando ' + metod);
        setTimeout(function(){ 
            window.location.replace("/spaceair/homepage.php");
        }, 1500);
    });
});