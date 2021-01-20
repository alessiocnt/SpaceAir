$(document).ready(function() {
    $(".btn_del").click(function(e) {
        const planet = e.target.id;
        //console.log(planet);
        $.post("/spaceair/controller/api/DeleteDestinationApi.php/", { planet: planet }, function(data) { 
                $("#msg-res").empty().append(data.msg);
            }, "json");
            setTimeout(function(){ 
                location.reload();
            }, 1500);
    });
});