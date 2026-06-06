// JavaScript Document
/*  Isotope utility GetUnitWidth
    ========================================================================== */
function getUnitWidth() {
	var width;
	if ($container.width() <= 320) {
		// console.log("320");
		width = Math.floor($container.width() / 1);
	} else if ($container.width() >= 321 && $container.width() <= 480) {
		//console.log("321 - 480");
		width = Math.floor($container.width() / 2);
	} else if ($container.width() >= 481 && $container.width() <= 768) {
		//console.log("481 - 768");
		width = Math.floor($container.width() / 4);
	} else if ($container.width() >= 769 && $container.width() <= 979) {
		//console.log("769 - 979");
		width = Math.floor($container.width() / 6);
	} else if ($container.width() >= 980 && $container.width() <= 1200) {
		//console.log("980 - 1200");
		width = Math.floor($container.width() / 6);
	} else if ($container.width() >= 1201 && $container.width() <= 1600) {
		//console.log("1201 - 1600");
		width = Math.floor($container.width() / 10);
	} else if ($container.width() >= 1601 && $container.width() <= 1824) {
		//console.log("1601 - 1824");
		width = Math.floor($container.width() / 10);
	} else if ($container.width() >= 1825) {
		//console.log("1825");
		width = Math.floor($container.width() / 12);
	}
	return width;
}

/*  Isotope utility SetWidths
    ========================================================================== */
function setWidths() {
	var unitWidth = getUnitWidth() - 0;
	$container.children(":not(.width2)").css({
		width: unitWidth
	});
	
	if ($container.width() >= 321 && $container.width() <= 480) {
		// console.log("eccoci 321");
		$container.children(".width2").css({
			width: unitWidth * 1
		});
		$container.children(".width4").css({
			width: unitWidth * 2
		});
		$container.children(".width6").css({
			width: unitWidth * 2
		});
	}
	if ($container.width() >= 481 && $container.width() <= 800) {
		// console.log("480");
		$container.children(".width6").css({
			width: unitWidth * 4
		});
		$container.children(".width4").css({
			width: unitWidth * 4
		});
		$container.children(".width2").css({
			width: unitWidth * 2
		});
	}
	if ($container.width() >= 801) {
		// console.log("480");
		$container.children(".width6").css({
			width: unitWidth * 6
		});
		$container.children(".width4").css({
			width: unitWidth * 4
		});
		$container.children(".width2").css({
			width: unitWidth * 2
		});
	} 
}

function callIsotope () {
	/*  Isotope
    ========================================================================== */
	$container = jQuery('#isotope');
	var unitWidth = getUnitWidth();
	//alert(unitWidth);
	// set the widths on page load
	setWidths();
	
	$container.imagesLoaded( function(){
		$container.isotope({
			//animationEngine : 'jquery',
			//transformsEnabled: false,
			// update columnWidth to a percentage of container width
			masonry: {
				columnWidth: getUnitWidth()
			},
			getSortData : {
				// ...
				category : function ( $elem ) {
					return $elem.attr('data-category');
				}
			},
				//sortBy : 'category',
				//sortAscending : true
			});
	});
	
	//filler items when filter link is clicked
	jQuery('#filters a').click(function() {
		var selector = jQuery(this).attr('data-category');
		jQuery('#filters a').removeClass('selected');
		jQuery(this).addClass('selected');
		$container.isotope({ filter: selector });
		return false;
	});
	
	// update columnWidth on window resize
	jQuery(window).smartresize(function() {
		//setGMapHeight();
		//getUnitW();
		// set the widths on resize
		setWidths();
		// reinit isotop
		$container.isotope({
			//animationEngine : 'jquery',
			//transformsEnabled: false,
			// update columnWidth to a percentage of container width
			masonry: {
				columnWidth: getUnitWidth()
			}
		});
		
	}).resize();
}
