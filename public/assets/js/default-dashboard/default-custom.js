
/*
  ================
      Message Scroll
  ================
*/

$(".message-scroll").mCustomScrollbar({
  scrollbarPosition:"outside",
  scrollInertia:450,
  theme:"dark-thin"
});


/*
  ================
      Top Search Scroll
  ================
*/

$(".top-search-scroll").mCustomScrollbar({
  axis:"yx",
  scrollbarPosition:"outside",
  scrollInertia:450,
  autoHideScrollbar: true,
  theme:"dark-thin"
});











// New Product table
// checkall('checkAll', 'chkbox');

// Latest Invoice table
// checkall('invoiceAll', 'invoicechk');

// jvector map script




// Monthly Charts

// var data = {
//   labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
//   series: [
    

//     [2, 3, 4, 3, 4, 1, 2],
//     [3, 2, 3, 2, 3, 4, 3]
//   ]
// };

// var options = {
//     seriesBarDistance: 10,
//     axisY: {
//         labelInterpolationFnc: function (value) {
//             return value + 'k';
//         },
//         onlyInteger: true,
//     }
// };

// var responsiveOptions = [
//   ['screen and (max-width: 575px)', {
//     seriesBarDistance: 5,
//     axisX: {
//       labelInterpolationFnc: function (value) {
//         return value[0];
//       }
//     }
//   }]
// ];

// new Chartist.Bar('.v-pv-weekly', data, options, responsiveOptions);




// Calender script
// $('.calendar').pignoseCalendar();

// Latest Activities scroll

$(".latest-activities-scroll").mCustomScrollbar({
    axis:"yx", // vertical and horizontal scrollbar
    autoHideScrollbar:true
});