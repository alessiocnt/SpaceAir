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
        $('div#my-paypal').attr('class', 'col-btn-impo col-text rounded my-2 p-1');
        $('div#my-credit-card').attr('class', 'col-back-white col-dark rounded my-2 p-1');
        metod = 'paypal';
        $('input#acq').prop('disabled', false);
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
        $('div#my-credit-card').attr('class', 'col-btn-impo col-text rounded my-2 p-1');
        $('div#my-paypal').attr('class', 'col-back-white col-dark rounded my-2 p-1');
        $('input#acq').prop('disabled', false);
    });
});