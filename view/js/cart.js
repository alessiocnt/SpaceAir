$(document).ready(function() {
    total();
    if($('section#cart > article').length > 0) {
        $("h1").text("Carrello");
    } else {
        $("h1").text("Carrello vuoto");
    }

    $("input").change(function(e) {
        $.post("/spaceair/controller/api/CartApi.php/", {"id": e.target.id, "qnt": e.target.value, "cod": e.target.name}, function(data) { 
            $("p#p" + e.target.name).text("Costo €" + data);
            total();
        });
    });

    $("a").click(function(e) {
        e.preventDefault();
        const packet = $(this).attr("class");
        const order = $(this).attr("id");
        const qnt = 0;
        $.post("/spaceair/controller/api/CartApi.php/", {"id": packet, "qnt": qnt, "cod": order}, function(data) { 
            $("p#p" + order).text("Costo €" + data);
            total();
        });
        $(this).parents("article").hide();
    });

    function total() {
        let tot = 0;
        $("p.totalPrice").each(function() {
            tot += Number($(this).text().split("€")[1]);
        })
        $("p#Totale").text("Totale €" + tot);
    }
}); 
