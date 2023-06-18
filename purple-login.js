document.getElementsByTagName("form")[0].addEventListener("submit",function(e){
    email = document.getElementsByName("email")[0];
    password = document.getElementsByName("password")[0];
    
    message = document.getElementsByTagName("span")[0];
    message.innerHTML = "";

    email.removeAttribute("class");
    password.removeAttribute("class");

    if(email.value == ""){
        message.innerHTML += "Email tidak boleh kosong<br>";
        email.setAttribute("class","warningBox");
    }

    const regexpass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{3,}$/;

    if(password.value == ""){
        message.innerHTML += "Password tidak boleh kosong<br>";
        password.setAttribute("class","warningBox");
    }
    else if(!regexpass.test(password.value)){
        message.innerHTML += "Password minimal 1 huruf besar, 1 huruf kecil, dan 1 angka<br>";
        password.setAttribute("class","warningBox");
    }

    if(message.innerHTML !=""){
        message.removeAttribute("hidden");
        e.preventDefault();
    }
})