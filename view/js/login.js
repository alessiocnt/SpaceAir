$(document).ready(function() {
    $("body main form").submit(function(e){
        e.preventDefault();
        const pwd = $('input[name="password"]');
        const pwdVal = pwd.val();
        const p = document.createElement("input");
        this.appendChild(p);
        p.name = "criptopassword";
        p.type = "hidden";
        p.value = hex_sha512(pwdVal);
        e.currentTarget.submit();
    });
});