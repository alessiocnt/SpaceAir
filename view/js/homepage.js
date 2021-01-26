$(document).ready(function(){
    $(".table-info-pl").hide();

    $(".btn-planet-img").click(function(e){
        let id = e.target.id;
        id = id.slice(4);
      $("#table-" + id).fadeToggle("slow");
    });
});