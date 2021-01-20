$(document).ready(function() {
    $(".btn_fav").click(function(e) {
        const planet = e.target.id;
console.log(planet);
        $.post("/spaceair/controller/api/DestinationsApi.php/", { planet: planet }, function(data) { 
                $("#fav-res").empty().append(data.msg);
            }, "json");
    });
});