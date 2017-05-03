function checkToken(){
    $.get("http://www.shoujiafeng.com/LiverpoolDock/API/verifyToken.php",function(status){ 
    if($.trim(status)=="false"){ window.location.href="login.html";}
    })
    setInterval("checkToken()", 60000)
    }