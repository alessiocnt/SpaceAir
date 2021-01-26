$(document).ready(function() {
    total();

    if($('section#cart > article').length > 0) {
        $("h1").text("Carrello");
    } else {
        $("h1").text("Carrello vuoto");
    }

    $("input").change(function(e) {
        $.post("/spaceair/controller/api/CartApi.php/", {id: e.target.id, qnt: $(this).val(), cod: e.target.name}, function(data) { 
            $("p#p" + e.target.id).text("Costo €" + data.price);
            total();
        },"json");
    });

    $("a.cart-remove").click(function(e) {
        e.preventDefault();
        const order = $(this).attr("class");
        const packet = $(this).attr("name");
        const qnt = 0;
        $.post("/spaceair/controller/api/CartApi.php/", {"id": packet, "qnt": qnt, "cod": order}, function(data) { 
            $("p#p" + packet).text("Costo €" + 0);
            total();
        });
        $(this).parents("article").slideUp();
    });

    $('form').submit(function (e) {
        $("p#Totale").removeAttr("disabled");
    });

    function total() {
        let tot = 0;
        $("p.totalPrice").each(function() {
            tot += Number($(this).text().split("€")[1]);
        })
        $("p#Totale").text("Totale € " + tot);
    }
}); 
