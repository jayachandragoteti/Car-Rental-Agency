/*++++++++++++++++++++++++++++++++++
          Page Calls
+++++++++++++++++++++++++++++++++++*/
ajaxAddNewCarsPageCall();
function ajaxAddNewCarsPageCall() {
  $.ajax({
    url: './pages/addNewCars.php',
    success: function (result) {
      $('#ajax-main-content').html(result);
      $('.addNewCar').addClass('active');
      $('.changePassword,.myCars,.bookedCars').removeClass('active');
    },
  });
}
function ajaxChangePasswordPageCall() {
  $.ajax({
    url: './pages/changePassword.php',
    success: function (result) {
      $('#ajax-main-content').html(result);
      $('.changePassword').addClass('active');
      $('.addNewCar,.myCars,.bookedCars').removeClass('active');
    },
  });
}
function ajaxMyCarsPageCall() {
  $.ajax({
    url: './pages/myCars.php',
    success: function (result) {
      $('#ajax-main-content').html(result);
      $('.changePassword').addClass('active');
      $('.addNewCar,.myCars,.bookedCars').removeClass('active');
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
// Update Password
function UpdatePassword() {
  $('.alert-bell').removeClass('d-none');
  $('.User-Password-Alerts').html('Loading...');
  var formData = {
    oldPassword: $('#oldPassword').val(),
    newPassword: $('#newPassword').val(),
    confirmPassword: $('#confirmPassword').val(),
    UpdatePassword: 'UpdatePassword',
  };
  if (
    formData.oldPassword == '' ||
    formData.newPassword == '' ||
    formData.confirmPassword == ''
  ) {
    $('.alert-bell').removeClass('d-none');
    $('.User-Password-Alerts').html('All fields must be filled!');
  } else if (formData.newPassword != formData.confirmPassword) {
    $('.alert-bell').removeClass('d-none');
    $('.User-Password-Alerts').html(
      'Password and confirm password should be same'
    );
  } else if (formData.confirmPassword.length < 8) {
    $('.alert-bell').removeClass('d-none');
    $('.User-Password-Alerts').html(
      'Password should contain at least eight characters'
    );
  } else {
    $.ajax({
      type: 'POST',
      url: './backScript.php',
      data: formData,
      success: function (response) {
        $('.User-Password-Alerts').html(response);
      },
    });
  }
}
