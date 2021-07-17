// NAVIGATION
// initializeStellarNav(1, '#main-nav');
// function initializeStellarNav(index, element) {
//     $(element).stellarNav({
//         breakpoint: 1024,
//         position: 'left'
//     });
// }

// INDEX CLIENT SLIDER
var swiper = new Swiper(".client-slider", {
	slidesPerView: 3,
    spaceBetween: 0,
	pagination: {
		el: ".client-slider .swiper-pagination",
		clickable: true,
		dynamicBullets: true,
	},
	breakpoints: {
	    0: {
	        slidesPerView: 1,
	    },
	    525: {
	        slidesPerView: 2,
	    },
	    769: {
	        slidesPerView: 3,
	    },
	}
}); 