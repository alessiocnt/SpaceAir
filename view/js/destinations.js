$(document).ready(function() {
    $(".btn_fav").click(function() {
        const planet = $(this).attr("id");
        $.post("./controller/api/DestinationsApi.php/", { planet: planet }, function(data) { 
                $("#fav-res").empty().append(data.msg);
            }, "json");
    });
});