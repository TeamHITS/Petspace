// NAVIGATION
// jQuery(document).ready(function($) {
//   jQuery('#main-nav').stellarNav({
//      breakpoint: 1024,
//      position: 'left'
//   });
// });

//STORE SETUP IMG
function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#uploaded_img').attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}


// INIT ORDER LIST DATATABLE
$(document).ready( function () {
    var table = $('#order-table').DataTable({
    	"ordering": false,
        "info":     false,
        "bLengthChange": false
    });
    $('.order-search').on( 'keyup', function () {
    	table.search( this.value ).draw();
	});
});



//******** DASHBOARD SLIDERS********
// ACTIVE ORDER SLIDER
var swiperActive = new Swiper('.dashbaord-active-order', {
  navigation: {
    nextEl: '.active-order-nav .swiper-button-next',
    prevEl: '.active-order-nav .swiper-button-prev',
  },
});
// SCHEDULE ORDER SLIDER
var swiperSchedule = new Swiper('.dashboard-schedule-order', {
  navigation: {
    nextEl: '.schedule-order-nav .swiper-button-next',
    prevEl: '.schedule-order-nav .swiper-button-prev',
  },
});
// NEW ORDER SLIDER
var swiperOrder = new Swiper('.dashboard-new-order', {
  navigation: {
    nextEl: '.new-order-nav .swiper-button-next',
    prevEl: '.new-order-nav .swiper-button-prev',
  },
});




//DATE RANGE PICKER
$(function() {
  $('#reportrange').daterangepicker({
    opens: 'left'
  });
});
// $(function() {
//     var start = moment().subtract(29, 'days');
//     var end = moment();
//     function cb(start, end) {
//         $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
//     }
//     $('#reportrange').daterangepicker({
//         "alwaysShowCalendars": true,
//         startDate: start,
//         endDate: end,
//         ranges: {
//            'Today': [moment(), moment()],
//            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
//            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
//            'This Month': [moment().startOf('month'), moment().endOf('month')],
//            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//         }
//     }, cb);
//     cb(start, end);
// });


// FILTER SIDEBAR
const filterOpen = document.getElementById('filter-side-toggle');
const filterSidebar = document.getElementById('filter-sidebar');
const filterclose = document.getElementById('close-filter-sidebar');
const filterOverlay = document.querySelector('.filter-sidebar-overlay');
filterOpen.addEventListener('click', function(){
  filterSidebar.classList.add('active');
  filterOverlay.classList.add('active');
});
filterclose.addEventListener('click', function(){
 filterSidebar.classList.remove('active');
 filterOverlay.classList.remove('active');
});
filterOverlay.addEventListener('click', function(){
 filterSidebar.classList.remove('active');
 filterOverlay.classList.remove('active');
});