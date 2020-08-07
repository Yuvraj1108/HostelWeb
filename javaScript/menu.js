
	var menu = false;
	$(".fa-bars.modify").click(function(){
		if(menu == false){
			$(".topNavigation").slideDown("slow");
			menu = true;
		}
		else{
			$(".topNavigation").slideUp("slow");
			menu = false;
		}
	})	