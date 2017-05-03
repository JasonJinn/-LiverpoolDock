  
   $(document).ready(function () {
   		 var baseurl = "http://www.shoujiafeng.com/LiverpoolDock/";
	$.getJSON(baseurl + "API/getMessage.php", function (data, Status) {
   		var getmessage = data; //store data in string gethomepage
   		$("#msgnumber").html(getmessage.length);
		$("#messagesnumber").html("You have "+getmessage.length+" unread messages");
		
   		for (index = 0; index < 4; index++) {
   			
   			$("#msgfrom" + index).html(getmessage[index].from);
   			$("#msgtime" + index).html(getmessage[index].time);
   			$("#msgphoto" + index).html("<img alt='avatar' src='"+getmessage[index].from_path+"'>");
			if(getmessage[index].content.length>20){
			var temp = getmessage[index].content.substring(0,20) 
			$("#msgcontent" + index).html(temp+"...")
			}else{
			$("#msgcontent" + index).html(getmessage[index].content);
			}
   			
   		}
   	});
	
		$.getJSON(baseurl + "API/notification.php", function (data, Status) {
				var getnotificationbutton = data;
				for (topindex = 0; topindex < 4; topindex++) {
					$("#notiphoto" + topindex).html("<i class='fa fa-clock-o'></i>");
					$("#notiname" + topindex).html(getnotificationbutton[topindex].name);
					$("#notitime" + topindex).html(getnotificationbutton[topindex].time);
					$("#notitype" + topindex).html(getnotificationbutton[topindex].type);
				}
			});
			 	$.getJSON(baseurl + "API/gethomepage.php", function (data, Status) {
	 		var gethomepage = [data]; //store data in string gethomepage
	 		$("#ownportrait").attr('src', gethomepage[0].path);
	 		$("#ownname").html(gethomepage[0].name);

	 	});
		
		$.getJSON(baseurl + "API/moduleList2.php", function (data, Status) {
	 		var getsidebarmodulelist = data; //store data in string gethomepage
	 		for (index = 0; index < getsidebarmodulelist.length; index++) {
	 		$("#sidebarmodules").append("<li><a  href='"+baseurl+"View/module.html?code="+getsidebarmodulelist[index].code+"'>"+getsidebarmodulelist[index].code+"-"+getsidebarmodulelist[index].name+"</a></li>");	
	 		}

	 	});
		
		
   });
