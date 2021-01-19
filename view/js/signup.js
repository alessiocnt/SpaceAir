function checkPwd(pwd) {
    return pwd.length >= 8;
}

$(document).ready(function() {
    $("body main form").submit(function(e){
        e.preventDefault();
        const pwd = $('input[name="password"]');
        const confPwd = $('input[name="confirmpassword"]');
        const pwdVal = pwd.val();
        const confPwdVal = confPwd.val();

        pwd.next().addClass("d-none");    
        confPwd.next().addClass("d-none");    
        
        if(pwdVal === confPwdVal) {
            if(checkPwd(pwdVal)) {
                const p = document.createElement("input");
                this.appendChild(p);
                p.name = "criptopassword";
                p.type = "hidden";
                p.value = hex_sha512(pwdVal);
                e.currentTarget.submit();
            } else {
                pwd.next().removeClass("d-none");    
            }
        } else {
            confPwd.next().removeClass("d-none");
        }
    });

    $("body main form input[type=file]").change(function() {
        const file = $(this).get(0).files[0];
        console.log("aaa");
        if(file){
            const reader = new FileReader();
 
            reader.onload = function(){
                $("#previewimg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    });
});