$(document).ready(function () {
    let metod = null;
    $('article#card').hide();

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
        const addr = $('#Addr').val();
        if(addr == "") {
            $('#paymentResult').text("Selezionare l'indirizzo di consegna");
            return;
        }
        $.post("/spaceair/controller/api/PaymentApi.php/", { codOrder: cod, addr: addr },
        function(data) {
            $('#paymentResult').text(data);
        });
        
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