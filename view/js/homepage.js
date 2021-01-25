$(document).ready(function(){
    $(".table-info-pl").hide();

    $(".btn-planet-img").click(function(e){
        let id = e.target.id;
        id = id.slice(4);
        console.log(id);;
      $("#table-" + id).fadeToggle("slow");
    });
});