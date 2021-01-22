$(document).ready(function () {
    const tot = $('p#tot').text().split('€')[1];
    let metod = null;
    $('article#card').hide();
    const cred = $('a#cred');
    const paypal = $('a#paypal');

    $('a#cred').click(function (e) {
        e.preventDefault();
        $('article#card').slideDown();
        metod = 'carta di credito';
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
        const cod = $('#CodOrder').val();
        
        $.post("/spaceair/controller/api/PaymentApi.php/", { codOrder: cod });
        $('#paymentResult').text('Complimenti hai acquistato con ' + metod);
        setTimeout(function(){ 
            window.location.replace("/spaceair/homepage.php");
        }, 1500);
    });

    $('#cardForm').submit(function (e) {
        e.preventDefault();
        $('article#card').slideUp();
        $('#paymentResult').text('Carta accettata');
        $('input#acq').prop('disabled', false);
    });
});