/*jQuery Functions for this theme */
(function($) {
	if ( jjOptions.adminBar == true ) {
		var adminHeight = 32;
	} else {
		var adminHeight = 0;
	}
	var viewport = $(window).height() - adminHeight + 5;
	var pageWidth = $("#page").width();
	var mobile = isMobile();

	$(document).ready(function () {
		$('.frontpage-image').hide();			//Hides big frontpage image
		$('body').flowtype({						//Initialize flowtype
			minimum   : 900,
			minFont   : 17,
			maxFont   : 19,
			fontRatio : 75
		});
		$(".entry-content").fitVids();
		mobileMenu();
		toTheTop();
		siteLayout();
		waypointRules();
		fadeMasthead();
		headerConflictManager();
		$(window).resize(function() {			//rules for when things get resized
			viewport = $(window).height() - adminHeight + 5;
			pageWidth = $("#page").width();
			siteLayout();
			waypointRules();
			headerConflictManager();
		});
	});
	$(window).load(function () {				//fades in big frontpage image
		$('.frontpage-image').fadeIn(1000);
	});

	function siteLayout() {
		var siteBrandingMargin = (viewport / 4) - $('.site-branding').height();
		var interiorBrandingMargin = ( $('.interior-header').outerHeight() - $('.site-branding').outerHeight() ) / 2;
		var frontpageDescriptionMargin = (viewport / 5) - $('.frontpage-description').height();

		if ( mobile == false ) {
			$(".frontpage-header").css({'height' : viewport });
			if (siteBrandingMargin > 18) {
				$(".frontpage-header .site-branding").css({'margin-top' : siteBrandingMargin});
			}
			if (frontpageDescriptionMargin > 18) {
				$(".frontpage-description").css({'bottom' : frontpageDescriptionMargin});
			}

			//vertical centering for interior header site branding
			$(".frontpage-header").css({'height' : viewport });
		//	if (interiorBrandingMargin > 18) {
				$(".interior-header .site-branding").css({'margin-top' : interiorBrandingMargin});
		//	}
		} else {
			interiorBrandingMargin = ( $('.interior-header').outerHeight() - ($('.site-title').outerHeight() + $('.site-description').outerHeight()) ) / 2;
			if (interiorBrandingMargin > 18) {
				$(".interior-header .site-branding").css({'padding-top' : interiorBrandingMargin});
			}
		}

		equalizeHeight('.footer-column');
		equalizeHeight('.portfolio-card .cardnothumb');
		equalizeHeight('.portfolio-card .cardhasthumb');
		equalizeHeight('.portfolio-card .entry-title');
		equalizeHeight('.portfolio-card .entry-content');

	}

	// EQUALIZE THE COLUMN HEIGHTS -- Elegant solution from 'ghayes' at: https://stackoverflow.com/questions/6781031/use-jquery-css-to-find-the-tallest-of-all-elements
	// Get an array of all element heights
	function equalizeHeight(element) {
		var elementHeights = $(element).map(function() {
			return $(this).outerHeight();
		}).get();

		// Math.max takes a variable number of arguments
		// `apply` is equivalent to passing each height as an argument
		var maxHeight = Math.max.apply(null, elementHeights);

		// Set each height to the max height
		$(element).css({'min-height' : maxHeight});
	}

	function waypointRules() {
		//hides #tothetop
		$("#tothetop").hide();

		//Rules for making the menu bar sticky
		if ( mobile == false ) {
			$("#site-navigation").waypoint(function (direction) {
				if (direction == "down") {
					$(".sticky-wrapper").css({"height" : $(this).height()});
					$(this).addClass("stuck").css({	'top' : adminHeight,
																'width' : pageWidth,
																'background-color' : '#f1f1f1',
																'opacity' : 0.95});
				} else if (direction == "up") {
					$(".sticky-wrapper").css({"height" : "auto"});
					$(this).removeClass("stuck").css({	'top' : 0,
																	'width' : 'auto',
																	'background-color' : '#e9e9e9',
																	'opacity' : 1});
				}
			}, {offset: adminHeight});
		}

		//Rules for showing #tothetop
		$("#page").waypoint(function (direction) {
			if (direction == "down") {
				$("#tothetop").fadeIn();
			} else {
				$("#tothetop").fadeOut();
			}
		}, {offset : viewport * -1});
	}

	//fades the masthead text on scroll -- THANKS TO AlexGach
	//(http://stackoverflow.com/questions/15995623/jquery-changing-opacity-of-an-element-while-scrolling)
	function fadeMasthead() {
		if ( mobile == false ) {
			$(document).scroll(function(){
				var top = $(this).scrollTop();
				var multiplier = viewport / 1.25;
				if(top < multiplier){
					var dif = 0.8 - top / multiplier;
					$(".site-branding").add(".frontpage-description").css({'opacity' : dif});
				}
			});
		}
	}

	//Deals with conflicts between .frontpage-description and .site-branding
	function headerConflictManager() {
		if ( $(".site-branding").outerHeight() + $(".frontpage-description").outerHeight() + 54 > viewport ) {
			$(".frontpage-description").css({'display' : 'none'});
		} else {
			$(".frontpage-description").css({'display' : ''});
		}
	}

	//takes the page back to the top
	function toTheTop() {
		$('#tothetop a').click(function(e){
			e.preventDefault();
			$("html, body").animate({ scrollTop: 0 }, 800);
		});
	}

	//SHOW OR HIDE THE MENU -- Thanks to tonal, by AUTOMATTIC
	function mobileMenu() {

		var menu = $('#mobile-button');
		var menuShow = $('#mobile-menu');

		function switchClass($myvar) {
			if ($myvar.hasClass('active')) {
			$myvar.removeClass('active');
			} else {
			$myvar.addClass('active');
			}
		}

		menu.on('click', function() {
			switchClass($(this));
			menuShow.slideToggle();
		});

	}

	// Detect mobile browsers
	// A variation on Michael Zaporozhets's solution at https://stackoverflow.com/questions/11381673/javascript-solution-to-detect-mobile-browser
	function isMobile() {
		if( navigator.userAgent.match(/Android/i)
			|| navigator.userAgent.match(/webOS/i)
			|| navigator.userAgent.match(/iPhone/i)
			|| navigator.userAgent.match(/iPad/i)
			|| navigator.userAgent.match(/iPod/i)
			|| navigator.userAgent.match(/BlackBerry/i)
			|| navigator.userAgent.match(/Windows Phone/i)
			|| typeof window.orientation !== 'undefined'
			|| $(window).width() < 768
		){
			return true;
		} else {
			return false;
		}
	}

})( jQuery );