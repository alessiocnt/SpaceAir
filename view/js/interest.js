$(document).ready(function () {
    $(".btn-int").click(function (e) {
        const planet = $(this).attr('id');
        $.post("/spaceair/controller/api/DeleteFavouriteApi.php/", { planet: planet }, function (data) {
            $("#removeResult").text(data.data);
        }, "json");
        $(this).parents('article').slideUp();
    });
});