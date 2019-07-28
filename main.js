// JavaScript Document
$( document ).ready(function() {
//  Foundation.util = {
    /**
     * Function for applying a debounce effect to a function call.
     * @function
     * @param {Function} func - Function to be called at end of timeout.
     * @param {Number} delay - Time in ms to delay the call of `func`.
     * @returns function
     */
    function throttle(func, delay) {
      var timer = null;

      return function () {
        var context = this,
            args = arguments;

        if (timer === null) {
          timer = setTimeout(function () {
            func.apply(context, args);
            timer = null;
          }, delay);
        }
      };
    };
//  };


// home page carousel

	$('.carousel').carousel({interval: 5000});


// drop down hover nav

	sessionStorage.aboutUsMenuOpen = 0;
	sessionStorage.servicesMenuOpen = 0;
	sessionStorage.resourcesMenuOpen = 0;
	
	$('#aboutUsMenu').parent().on('show.bs.dropdown', function () {
	  sessionStorage.aboutUsMenuOpen = 1;
	})
	$('#aboutUsMenu').parent().on('hidden.bs.dropdown', function () {
	  sessionStorage.aboutUsMenuOpen = 0;
	})
	$('#servicesMenu').parent().on('show.bs.dropdown', function () {
	  sessionStorage.servicesMenuOpen = 1;
	})
	$('#servicesMenu').parent().on('hidden.bs.dropdown', function () {
	  sessionStorage.servicesMenuOpen = 0;
	})
	$('#resourcesMenu').parent().on('show.bs.dropdown', function () {
	  sessionStorage.resourcesMenuOpen = 1;
	})
	$('#resourcesMenu').parent().on('hidden.bs.dropdown', function () {
	  sessionStorage.resourcesMenuOpen = 0;
	})
	
	docLinks = document.getElementsByTagName('A');
	for(i=0;i<docLinks.length;i++)
	{
		if(docLinks[i].className == "dropdown-toggle")
		{
		docLinks[i].onclick = function() {
			thisMenu = this.id + "Open";
				if(sessionStorage[thisMenu] == 1)
				{
				sessionStorage[thisMenu] = 0;
				window.location = this.href;
				}
			};
		}
	}

$('.navbar [class="dropdown-toggle"]').bootstrapDropdownHover({hideTimeout:750});



// home page callout boxes

	if(document.getElementById('homePage'))
	{
	document.getElementById('calloutIndustryNews').onclick = function() {
		window.location = "https://hrdoneright.com/newsletter.php";
		};
	document.getElementById('calloutLetsChat').onclick = function() {
		window.location = "https://hrdoneright.com/contact.php";
		};
	document.getElementById('calloutWhyHRDR').onclick = function() {
		window.location = "https://hrdoneright.com/about_us.php";
		};
	document.getElementById('calloutContact').onclick = function() {
		window.location = "https://hrdoneright.com/contact.php";
		};
	document.getElementById('calloutBlog').onclick = function() {
		window.location = "http://hrdoneright.com/blog.php";
		};
	document.getElementById('calloutFacebook').onclick = function() {
		window.open("https://www.facebook.com/hrdoneright");
		return false;
		};
	document.getElementById('calloutLinkedIn').onclick = function() {
		window.open("https://www.linkedin.com/company/hr-done-right");
		return false;
		};
	}


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

// accordion tabs

if(document.getElementById('servicesPage'))
{
urlServices = getUrlVars()["page"];

var docSpans = document.getElementsByTagName('SPAN');
	for(i=0;i<docSpans.length;i++)
	{
		if(docSpans[i].className == "subSubNavItem")
		{
			docSpans[i].onclick = function()
			{
				if(document.getElementById( this.id + "Content" ).style.display == "none")
				{
				resetSubSubNav();
				$('#' + this.id + 'Content').show(200);
				this.className += " activeTab";
				document.getElementById( this.id + "li" ).style.backgroundColor = "#fff";
				var openedContent = '#' + this.id + "Content";
				$('html, body').scrollTop($(openedContent).offset().top);
				}
				else
				{
				resetSubSubNav();
				document.getElementById( this.id + "Content" ).style.display = "none";
				this.className = "subSubNavItem"
				}
			return false;
			}
		}
	}

	if(urlServices != "" && (typeof urlServices !== "undefined"))
	{
	$("#" + urlServices).click();
	}
	else
	{
	$("#OutsourcedHR").click();
	}

}

function resetSubSubNav()
{
var docSpans = document.getElementsByTagName('SPAN');
for(i=0;i<docSpans.length;i++)
	{
	if(docSpans[i].className == "subSubNavItem activeTab" || docSpans[i].className == "subSubNavItem")
		{
		document.getElementById( docSpans[i].id + "Content" ).style.display = "none";
		document.getElementById( docSpans[i].id + "li" ).style.background = "none";
		docSpans[i].className = "subSubNavItem";
		}
	}
}
	
	
// blog page pop boxes, read more links

	if(document.getElementById('blogPage'))
	{
		
		// Optimalisation: Store the references outside the event handler:
		var $window = jQuery(window);

		function checkWidth() {
			var windowsize = $window.width();
			return windowsize;
		}

		// Execute on load
		
		//initialWindowSize = checkWidth();
		
		
		
		function responsiveElements() {
		//currentWindowSize = checkWidth();
			tallestPop = 250;
			
			$(".postPop").css("minHeight", "inherit");
			
			$( ".postPop" ).each(function() {
			currentPopHeight = $( this ).outerHeight();

				if(currentPopHeight > tallestPop)
				{
					tallestPop = currentPopHeight;
				}
			});

			$(".postPop").css("minHeight", tallestPop);
			//alert("responsive elements ran");
		}
		
		
		$( ".postPop" ).each(function() {
			
			$( this ).click(function() {
					postID = $(this).attr('id');
					postID = postID.replace('postPop', '');
				url = "blog.php?post=" + postID;
				window.location = url;
				});
		});
		
		
		/*$( ".readMore" ).each(function() {
			postID = $(this).attr('id');
			postID = postID.replace('readMore', '');
			containerClass = "blogPost" + postID;
			$( "." + containerClass ).append( $( this ) );
		});*/
	
		//bind event listener
		$(window).on('resize', throttle(function(e){
			responsiveElements();
		}, 300));
	
		
		//run on load
		responsiveElements();
	}

});