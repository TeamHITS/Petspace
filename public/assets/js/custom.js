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
    var start = moment().subtract(29, 'days');
    var end = moment();
    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);
    cb(start, end);
});

// CALNEDER SCRIPTS
// var calendar = new tui.Calendar(document.getElementById('calendar'), {
//     defaultView: 'month',
//     usageStatistics: false,
//     taskView: true,    // Can be also ['milestone', 'task']
//     scheduleView: true,  // Can be also ['allday', 'time']
//     month: {
//         daynames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
//         startDayOfWeek: 0
//     },
//     week: {
//         daynames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
//         startDayOfWeek: 0
//     }
// });

// CALNEDER SCRIPTS
/*
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      initialDate: '2021-05-12',
      navLinks: true, // can click day/week names to navigate views
      businessHours: true, // display business hours
      editable: true,
      selectable: true,

      //When u select some space in the calendar do the following:
      select: function (start, end, allDay) {
          //do something when space selected
          //Show 'add event' modal
          $('#addCalenderEvent').modal('show');
      },
      eventClick: function (event, jsEvent, view) {
          $('#editCalenderEvent').modal('show');
      },

      events: [
        {
          title: 'Business Lunch',
          start: '2021-05-03T13:00:00',
          constraint: 'businessHours'
        },
        {
          title: 'Meeting',
          start: '2021-05-13T11:00:00',
          constraint: 'availableForMeeting', // defined below
          color: '#257e4a'
        },
        {
          title: 'Conference',
          start: '2021-05-18',
          end: '2020-09-20'
        },
        {
          title: 'Party',
          start: '2021-05-29T20:00:00'
        },

        // areas where "Meeting" must be dropped
        {
          groupId: 'availableForMeeting',
          start: '2020-09-11T10:00:00',
          end: '2020-09-11T16:00:00',
          display: 'background'
        },
        {
          groupId: 'availableForMeeting',
          start: '2020-09-13T10:00:00',
          end: '2020-09-13T16:00:00',
          display: 'background'
        },

        // red areas where no events can be dropped
        {
          start: '2020-09-24',
          end: '2020-09-28',
          overlap: false,
          display: 'background',
          color: '#ff9f89'
        },
        {
          start: '2020-09-06',
          end: '2020-09-08',
          overlap: false,
          display: 'background',
          color: '#ff9f89'
        }
      ]
    });

    calendar.render();
  });
*/

/*var datepicker = new tui.DatePicker('#add-date-wrapper', {
    date: new Date(),
    input: {
      element: '#add-datepicker-input',
      format: 'dd-MM-yyyy'
    }
  });
  var datepicker2 = new tui.DatePicker('#edit-date-wrapper', {
    date: new Date(),
    input: {
      element: '#edit-datepicker-input',
      format: 'dd-MM-yyyy'
    }
  });

  var datepicker3 = new tui.DatePicker('#date-wrapper-3', {
    date: new Date(),
    input: {
      element: '#datepicker-input-3',
      format: 'dd-MM-yyyy'
    }
  });

  var datepicker4 = new tui.DatePicker('#date-wrapper-4', {
    date: new Date(),
    input: {
      element: '#datepicker-input-4',
      format: 'dd-MM-yyyy'
    }
  });*/


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