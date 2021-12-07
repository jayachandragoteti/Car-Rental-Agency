/*++++++++++++++++++++++++++++++++++
          Page Calls
+++++++++++++++++++++++++++++++++++*/
ajaxAddNewCarsPageCall();
function ajaxAddNewCarsPageCall() {
  $.ajax({
    url: './pages/addNewCars.php',
    success: function (result) {
      $('#ajax-main-content').html(result);
    },
  });
}
// function ajaxAddEventPageCall() {
//   $.ajax({
//     url: './pages/addEvent.php',
//     success: function (result) {
//       $('#ajax-main-content').html(result);
//     },
//   });
// }
// function ajaxAddGalleryPageCall() {
//   $.ajax({
//     url: './pages/addGallery.php',
//     success: function (result) {
//       $('#ajax-main-content').html(result);
//     },
//   });
// }
// function ajaxAddTestimonialPageCall() {
//   $.ajax({
//     url: './pages/addTestimonial.php',
//     success: function (result) {
//       $('#ajax-main-content').html(result);
//     },
//   });
// }

/*++++++++++++++++++++++++++++++++++
          End Page Calls
+++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++*/
// Add New Cars
function addNewCar() {
  $('.add-New-Cars-alerts').html('Loading..');
  var form = $('#addNewCarsForm')[0];
  var formData = new FormData(form);
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: formData,
    contentType: false,
    processData: false,
    success: function (Response) {
      $('.add-New-Cars-alerts').html(Response);
    },
  });
}
