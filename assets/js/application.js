jQuery( document ).ready(function($){
	var $baseSubmenu = false;
	
	//Find the active submenu if there is one.
	if($(".baseSubmenu").length > 0) {
		$baseSubmenu = $(".baseSubmenu");
	}
	
	//Show submenu on main menu hover.
	$('.mainMenu a.dropdownOwner').hover(function(e) {
		$(".sub-menu > div ").removeClass("d-block");
		
		var submenuClass = $(e.target).attr('id');
		var subMenuWrapper = $(".sub-menu").find('[data-wrapper="' + submenuClass + '"]');
		
		subMenuWrapper.fadeIn(500).addClass("d-block");
	});
	
	//Rollback baseSubmenu if there was one.
	$(".sub-menu > div").mouseleave(function(){
		if($baseSubmenu != false) {
			$(".sub-menu > div ").removeClass("d-block");
			
			$baseSubmenu.stop(true, true).delay(200).fadeIn(500).addClass("d-block");
		}
	});
	
	
	//Actions for responsive menu.
	$('.responsiveMenu > ul > li.hasSub > a').click(function(e) {
		e.preventDefault();
		$(this).next("ul").toggle("d-block");
	});
	
	//responsive menu
	$(".navbar-toggler").click(function(){
		$(".responsiveMenu").fadeIn();
		$("header, article, footer, section").fadeOut();
	});
	$(".closeResponsiveMenu").click(function(){
		$(".responsiveMenu").fadeOut();
		$("header, article, footer, section").fadeIn();
	});
	
	
	//Neko sranje
	
		
	// javascript get variables
	function getUrlVars()
	{
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,    
		function(m,key,value) {
		  vars[key] = value;
		});
	return vars;
	}
	urlServices = getUrlVars()["page"];

	$("#" + urlServices + "Content").show();

});