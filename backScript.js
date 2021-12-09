/*******************************************************************************/
/*******************************************************************************/
ajaxHomePageCall();
// ========== Ajax Page Calls ==========
// Home Page Call
function ajaxHomePageCall() {
  $.ajax({
    url: './pages/Home.php',
    success: function (response) {
      $('.ajax-main-content').html(response);
      $('.Home').addClass('active');
      $(
        '.Register,.MyRequests,.MyRequests,.ChangePassword,.Profile,.Login'
      ).removeClass('active');
      availableCarsResponse();
      setInterval(function () {
        availableCarsResponse();
      }, 30000);
    },
  });
}
// Register Page Call
function ajaxRegisterPageCall() {
  $.ajax({
    url: './pages/register.php',
    success: function (response) {
      $('.ajax-main-content').html(response);
      $('.Register').addClass('active');
      $(
        '.Home,.MyRequests,.MyRequests,.ChangePassword,.Profile,.Login'
      ).removeClass('active');
    },
  });
}
// My Requests Page Call
function ajaxMyRequestsPageCall() {
  $.ajax({
    url: './pages/myRequests.php',
    success: function (response) {
      $('.ajax-main-content').html(response);
      $('.MyRequests').addClass('active');
      $(
        '.Home,.Register,.MyRequests,.ChangePassword,.Profile,.Login'
      ).removeClass('active');
      myBookingsList();
    },
  });
}
// Change Password Page Call
function ajaxChangePasswordPageCall() {
  $.ajax({
    url: './pages/changePassword.php',
    success: function (response) {
      $('.ajax-main-content').html(response);
      $('.ChangePassword').addClass('active');
      $('.Home,.Register,.MyRequests,.Profile,.Login').removeClass('active');
    },
  });
}
// Profile Page Call
function ajaxProfilePageCall() {
  $.ajax({
    url: './pages/profile.php',
    success: function (response) {
      $('.ajax-main-content').html(response);
      $('.Profile').addClass('active');
      $('.Home,.Register,.MyRequests,.ChangePassword,.Login').removeClass(
        'active'
      );
    },
  });
}
// Login Page Call
function ajaxLoginPageCall() {
  $.ajax({
    url: './pages/login.php',
    success: function (response) {
      $('.ajax-main-content').html(response);
      $('.Login').addClass('active');
      $('.Home,.Register,.MyRequests,.ChangePassword,.Profile').removeClass(
        'active'
      );
    },
  });
}
// ========== End Ajax Page Calls ==========

/*******************************************************************************/
/*******************************************************************************/

// RentalAgency Registration
function rentalAgencyRegistration() {
  $('.alert-bell').removeClass('d-none');
  $('.RentalAgency-Registration-Alerts').html('Loading..');
  var form = $('#RentalAgencyRegistrationForm')[0];
  var formData = new FormData(form);
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: formData,
    contentType: false,
    processData: false,
    success: function (Response) {
      $('.alert-bell').removeClass('d-none');
      $('.RentalAgency-Registration-Alerts').html(Response);
    },
  });
}
// Customers Registration
function customersRegistration() {
  $('.alert-bell').removeClass('d-none');
  $('.Customers-Registration-Alerts').html('Loading..');
  var form = $('#CustomersRegistrationForm')[0];
  var formData = new FormData(form);
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: formData,
    contentType: false,
    processData: false,
    success: function (Response) {
      $('.alert-bell').removeClass('d-none');
      $('.Customers-Registration-Alerts').html(Response);
      // $('.SellerRegistrationErrors').html(Response);
      // if (Response == '*Successfully registered as seller.') {
      //   window.location.assign('index.php');
      // }
    },
  });
}
// User Login
function userLogin() {
  $('.alert-bell').removeClass('d-none');
  $('.User-Login-Alerts').html('Loading...');
  var formData = {
    loginEmail: $('#loginEmail').val(),
    loginPassword: $('#loginPassword').val(),
    LoginType: $('#LoginType').val(),
    UserLogin: 'UserLogin',
  };
  if (
    formData.loginEmail == '' ||
    formData.loginPassword == '' ||
    formData.LoginType == ''
  ) {
    $('.alert-bell').removeClass('d-none');
    $('.User-Login-Alerts').html('All fields must be filled!');
  } else {
    $.ajax({
      type: 'POST',
      url: './backScript.php',
      data: formData,
      success: function (response) {
        $('.alert-bell').removeClass('d-none');
        $('.User-Login-Alerts').html(response);
        if (response == 'loggedSuccessfully') {
          window.location.assign('index.php');
        }
      },
    });
  }
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
        $('.alert-bell').removeClass('d-none');
        $('.User-Password-Alerts').html(response);
      },
    });
  }
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
      $('.alert-bell').removeClass('d-none');
      $('.update-profile-data-Alerts').html(Response);
      setTimeout(function () {
        ajaxProfilePageCall();
      }, 5000);
    },
  });
}
// Update profile Pic
function profilePicUpdate() {
  $('.alert-bell').removeClass('d-none');
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
      $('.alert-bell').removeClass('d-none');
      $('.update-profile-data-Alerts').html(Response);
      setTimeout(function () {
        ajaxProfilePageCall();
      }, 5000);
    },
  });
}
// Available CarsResponse
function availableCarsResponse() {
  var City = $('#availableCarsCityFilter').val();
  var availableCarsGroupFilter = $('#availableCarsGroupFilter').val();
  var availabilityFilter = $('#availabilityFilter').val();
  var availableSeatingCapacityFilter = $(
    '#availableSeatingCapacityFilter'
  ).val();
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: {
      AvailableCarsResponse: 'AvailableCarsResponse',
      City: City,
      availableCarsGroupFilter: availableCarsGroupFilter,
      availableSeatingCapacityFilter: availableSeatingCapacityFilter,
      availabilityFilter: availabilityFilter,
    },
    success: function (response) {
      $('.AvailableCarsResponse').html(response);
    },
  });
}

// Available CarsResponse
function viewCarDetails(vehicleNo) {
  let formData = {
    viewCarDetails: 'viewCarDetails',
    vehicleNo,
  };
  $.ajax({
    type: 'POST',
    url: './pages/viewMyCar.php',
    data: formData,
    success: function (response) {
      $('.ajax-main-content').html(response);
      $(
        '.Home,.Register,.MyRequests,.MyRequests,.ChangePassword,.Profile,.Login'
      ).removeClass('active');
    },
  });
}
// Book Your Car
function bookYourCar(vehicleNo) {
  let formData = {
    bookYourCar: 'bookYourCar',
    vehicleNo: vehicleNo,
    startingDate: $('#startingDate').val(),
    noDaysToRent: $('#noDaysToRent').val(),
  };
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: formData,
    success: function (response) {
      $('.book-your-car-alerts').html(response);
    },
  });
}

function myBookingsList() {
  let formData = {
    myBookingsList: 'myBookingsList',
  };
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: formData,
    success: function (response) {
      $('.myRequestsResponse').html(response);
    },
  });
}
