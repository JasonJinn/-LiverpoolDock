function PasswordConfirm(){
             var password=document.getElementById("reg-password").value;
			 var passwordconfirm=document.getElementById("reg-confirmpassword").value;
             if(passwordconfirm==""||password!=passwordconfirm){                 
             $("#reg-confirmpassword").attr('style','border-color:red');
             }else{
			 $("#reg-confirmpassword").attr('style','');
			 }
        }
		
function PasswordCheck(){
             var password=document.getElementById("reg-password").value;
			 if(password==""||password.length>15){   
             $("#reg-password").attr('style','border-color:red');
             }else{
			 $("#reg-password").attr('style','');
			 }
        }

function EmailCheck(){
             var email=document.getElementById("reg-email").value;
			 var pattern = /^[\w\.]+@[\w\.]+(\.\w+)+$/;
			 if(email=""||!pattern.test(email)){   
             $("#reg-email").attr('style','border-color:red');
             }else{
			 $("#reg-email").attr('style','');
			 }
        }
		
function SurnnameCheck(){
             var surnname=document.getElementById("reg-surnname").value;
			 
			 if(surnname==""){   
             $("#reg-surnname").attr('style','border-color:red');
             }else{
			 $("#reg-surnname").attr('style','');
			 }
        }
		
function GivennameCheck(){
             var givenname=document.getElementById("reg-givenname").value;
			 
			 if(givenname==""){   
             $("#reg-givenname").attr('style','border-color:red');
             }else{
			 $("#reg-givenname").attr('style','');
			 }
        }
