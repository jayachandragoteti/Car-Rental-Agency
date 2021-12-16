ajaxDashboardPageCall();
// Jquery search
$('#searchInput').on('keyup', function () {
  var value = $(this).val().toLowerCase();
  $('#searchTable tr').filter(function () {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
  });
});
/*++++++++++++++++++++++++++++++++++
          Page Calls
+++++++++++++++++++++++++++++++++++*/
function ajaxDashboardPageCall() {
  $.ajax({
    url: './pages/dashboard.php',
    success: function (result) {
      $('#ajax-main-content').html(result);
      bookingRequests();
      setInterval(function () {
        bookingRequests();
      }, 10000);
      $('.dashboard').addClass('active');
      $('.changePassword,.myCars,.bookedCars,.addNewCar').removeClass('active');
    },
  });
}
function ajaxAddNewCarsPageCall() {
  $.ajax({
    url: './pages/addNewCars.php',
    success: function (result) {
      $('#ajax-main-content').html(result);
      $('.addNewCar').addClass('active');
      $('.changePassword,.myCars,.bookedCars,.dashboard').removeClass('active');
    },
  });
}
function ajaxChangePasswordPageCall() {
  $.ajax({
    url: './pages/changePassword.php',
    success: function (result) {
      $('#ajax-main-content').html(result);
      $('.changePassword').addClass('active');
      $('.addNewCar,.myCars,.bookedCars,.dashboard').removeClass('active');
    },
  });
}
function ajaxMyCarsPageCall() {
  $.ajax({
    url: './pages/myCars.php',
    success: function (result) {
      $('#ajax-main-content').html(result);
      $('.myCars').addClass('active');
      $('.addNewCar,.changePassword,.bookedCars,.dashboard').removeClass(
        'active'
      );
      myCarsList();
      setInterval(function () {
        myCarsList();
      }, 30000);
    },
  });
}
function ajaxBookedCarsPageCall() {
  $.ajax({
    url: './pages/bookedCars.php',
    success: function (result) {
      $('#ajax-main-content').html(result);
      $('.bookedCars').addClass('active');
      $('.addNewCar,.myCars,.changePassword,.dashboard').removeClass('active');
      myBookedCarsList();
      setInterval(function () {
        myBookedCarsList();
      }, 30000);
    },
  });
}
// Profile Page Call
function ajaxProfilePageCall() {
  $.ajax({
    url: './pages/profile.php',
    success: function (response) {
      $('#ajax-main-content').html(response);
      $(
        '.addNewCar,.myCars,.changePassword,.dashboard,.bookedCars'
      ).removeClass('active');
    },
  });
}
/*++++++++++++++++++++++++++++++++++
          End Page Calls
+++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++*/
// Add New Cars
function addNewCar() {
  $('.add-New-Cars-alerts').html('Loading..');
  let form = $('#addNewCarsForm')[0];
  let formData = new FormData(form);
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
  let formData = {
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
// My Cars List
function myCarsList() {
  let formData = {
    myCarsList: 'My Cars List',
    ShowRows: $('#ShowRows').val(),
  };
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: formData,
    success: function (response) {
      $('.my-cars-list-data').html(response);
    },
  });
}
// My Booked Cars List
function myBookedCarsList() {
  let formData = {
    myBookedCarsList: 'myBookedCarsList',
    ShowRows: $('#ShowRows').val(),
  };
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: formData,
    success: function (response) {
      $('.booked-cars-list-data').html(response);
    },
  });
}
// My Car Delete
function myCarDelete(carNumber) {
  let formData = {
    carNumber: carNumber,
    myCarDelete: 'myCarDelete',
  };
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: formData,
    success: function (response) {
      $('.my-car-list-alerts').html(response);
    },
  });
}
// View My Car
function viewMyCar(carNumber) {
  let formData = {
    carNumber: carNumber,
    viewMyCar: 'viewMyCar',
  };
  $.ajax({
    type: 'POST',
    url: './pages/viewMyCar.php',
    data: formData,
    success: function (response) {
      $('#ajax-main-content').html(response);
    },
  });
}
// Update profile Data
function updateProfileData() {
  $('.alert-bell').removeClass('d-none');
  $('.update-profile-data-Alerts').html('Loading..');
  var form = $('#updateProfileDataForm')[0];
  var formData = new FormData(form);
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: formData,
    contentType: false,
    processData: false,
    success: function (Response) {
      $('.update-profile-data-Alerts').html(Response);
      setTimeout(function () {
        ajaxProfilePageCall();
      }, 5000);
    },
  });
}
// Update profile Pic
function profilePicUpdate() {
  $('.update-profile-data-Alerts').html('Loading..');
  var form = $('#updateProfilePicForm')[0];
  var formData = new FormData(form);
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: formData,
    contentType: false,
    processData: false,
    success: function (Response) {
      $('.update-profile-data-Alerts').html(Response);
      setTimeout(function () {
        ajaxDashboardPageCall();
      }, 5000);
    },
  });
}
// Rental Agency Car Pic Update
function rentalAgencyCarPicUpdate(carNumber) {
  $('.rental-agency-car-pic-update-alerts').html('Loading..');
  var form = $('#updateRentalAgencyCarPicForm')[0];
  var formData = new FormData(form);

  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: formData,
    contentType: false,
    processData: false,
    success: function (Response) {
      $('.rental-agency-car-pic-update-alerts').html(Response);
      setTimeout(function () {
        viewMyCar(carNumber);
      }, 5000);
    },
  });
}
// Rental Agency Car Data Update
function rentalAgencyCarDataUpdate(carNumber) {
  $('.rental-agency-car-data-update-alerts').html('Loading..');
  var form = $('#updateRentalAgencyCarDataForm')[0];
  var formData = new FormData(form);

  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: formData,
    contentType: false,
    processData: false,
    success: function (Response) {
      $('.rental-agency-car-data-update-alerts').html(Response);
      var newCarNumber = Response.split('.');
      setTimeout(function () {
        viewMyCar(newCarNumber['1']);
      }, 5000);
    },
  });
}

// Booking Requests
function bookingRequests() {
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: {
      bookingRequests: 'bookingRequests',
      ShowRows: $('#ShowRows').val(),
    },
    success: function (Response) {
      $('.booked-cars-list-data').html(Response);
    },
  });
}
// Accept Booking Request
function acceptBookingRequest(bookingId) {
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: {
      acceptBookingRequest: 'acceptBookingRequest',
      bookingId: bookingId,
    },
    success: function (Response) {
      $('.Booking-requests-data-Alerts').html(Response);
    },
  });
}

// Reject Booking Request
function rejectBookingRequest(bookingId) {
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: {
      rejectBookingRequest: 'rejectBookingRequest',
      bookingId: bookingId,
    },
    success: function (Response) {
      $('.Booking-requests-data-Alerts').html(Response);
    },
  });
}
// View Customer
function viewCustomer(userId) {
  $.ajax({
    type: 'POST',
    url: './pages/viewCustomer.php',
    data: {
      userId: userId,
    },
    success: function (Response) {
      $('#ajax-main-content').html(Response);
    },
  });
}
