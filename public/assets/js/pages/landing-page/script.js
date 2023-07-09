/*
  ==============================
		Smooth Scrolling Script
	==============================
*/

  
  // Add scrollspy to <body>
  // $('body').scrollspy({target: ".navbar", offset: 50});

  // Add smooth scrolling on all links inside the navbar
  $("#nav-content a").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800);
    }  // End if
  });


/*
	============================================================
		Change nav color on click of the hamburger icon menu
	============================================================
*/

$("nav.navbar button.navbar-toggler").click(function(event) {
	var scroll = $(window).scrollTop();
	var ariaExpand = $(this).attr('aria-expanded');
	// console.log( ariaExpand );

	if (scroll != 0) {
		if (ariaExpand == 'false') {
			$('nav.navbar').addClass('scrolling');
		}
	} else {
		if (ariaExpand == 'true') {
			setTimeout( function(){
				$('nav.navbar').removeClass('scrolling');
			}, 250);
		} else if (ariaExpand == 'false') {
			$('nav.navbar').addClass('scrolling');
		}
	}
});


// Scroll To Top

$(document).on('click', '.arrow', function(event) {
	event.preventDefault();
	var body = $("html, body");
	body.stop().animate({scrollTop:0}, 500, 'swing');
});
