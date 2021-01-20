$(document).ready(function() {
    total();

    $("input").change(function(e) {
        $.post("/spaceair/controller/api/CartApi.php/", {"id": e.target.id, "qnt": e.target.value, "cod": e.target.name}, function(data) { 
            $("p#p" + e.target.name).text("Costo €" + data);
            total();
        });
    });

    function total() {
        let tot = 0;
        $("p.totalPrice").each(function() {
            tot += Number($(this).text().split("€")[1]);
        })
        $("p#Totale").text("Totale €" + tot);
    }
}); 
