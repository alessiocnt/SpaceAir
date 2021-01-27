$(document).ready(function() {
    $("body main form input[type=file]").change(function() {
        const file = $(this).get(0).files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(){
            $("#previewimg").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    });
});