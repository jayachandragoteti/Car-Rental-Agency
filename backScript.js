/*******************************************************************************/
/*******************************************************************************/
ajaxHomePageCall();
// ========== Ajax Page Calls ==========
// Home Page Call
function ajaxHomePageCall() {
  $('.ajax-main-content').html(
    '<img src="./assets/images/loging.gif" style="width:100%;"/>'
  );
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
  $('.ajax-main-content').html(
    '<img src="./assets/images/loging.gif" style="width:100%;"/>'
  );
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
  $('.ajax-main-content').html(
    '<img src="./assets/images/loging.gif" style="width:100%;"/>'
  );
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
  $('.ajax-main-content').html(
    '<img src="./assets/images/loging.gif" style="width:100%;"/>'
  );
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
  $('.ajax-main-content').html(
    '<img src="./assets/images/loging.gif" style="width:100%;"/>'
  );
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
  $('.RentalAgency-Registration-Alerts').html(
    '<p class="text-danger"><i class="fas fa-spinner"></i> Loading...</p>'
  );
  var form = $('#RentalAgencyRegistrationForm')[0];
  var formData = new FormData(form);
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: formData,
    contentType: false,
    processData: false,
    success: function (Response) {
      $('.RentalAgency-Registration-Alerts').html(Response);
    },
  });
}
// Customers Registration
function customersRegistration() {
  $('.Customers-Registration-Alerts').html(
    '<p class="text-danger"><i class="fas fa-spinner"></i> Loading...</p>'
  );
  var form = $('#CustomersRegistrationForm')[0];
  var formData = new FormData(form);
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: formData,
    contentType: false,
    processData: false,
    success: function (Response) {
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
  $('.User-Login-Alerts').html(
    '<p class="text-danger"><i class="fas fa-spinner"></i> Loading...</p>'
  );
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
    $('.User-Login-Alerts').html(
      '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> All fields must be filled!</p>'
    );
  } else {
    $.ajax({
      type: 'POST',
      url: './backScript.php',
      data: formData,
      success: function (response) {
        $('.User-Login-Alerts').html(response);
        if (response == 'loggedSuccessfully.') {
          window.location.assign('index.php');
        }
      },
    });
  }
}
// Update Password
function UpdatePassword() {
  $('.User-Password-Alerts').html(
    '<p class="text-danger"><i class="fas fa-spinner"></i> Loading...</p>'
  );
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
    $('.User-Password-Alerts').html(
      '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> All fields must be filled!</p>'
    );
  } else if (formData.newPassword != formData.confirmPassword) {
    $('.User-Password-Alerts').html(
      '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Password and confirm password should be same</p>'
    );
  } else if (formData.confirmPassword.length < 8) {
    $('.User-Password-Alerts').html(
      '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Password should contain at least eight characters</p>'
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
// Update profile Data
function updateProfileData() {
  $('.update-profile-data-Alerts').html(
    '<p class="text-danger"><i class="fas fa-spinner"></i> Loading...</p>'
  );
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
  $('.update-profile-data-Alerts').html(
    '<p class="text-danger"><i class="fas fa-spinner"></i> Loading...</p>'
  );
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
        ajaxProfilePageCall();
      }, 5000);
    },
  });
}
// Available CarsResponse
function availableCarsResponse() {
  var City = $('#availableCarsCityFilter').val();
  var availableCarsGroupFilter = $('#availableCarsModelsFilter').val();
  var availabilityFilter = $('#availabilityFilter').val();
  var ShowRows = $('#ShowRows').val();
  var availableSeatingCapacityFilter = $(
    '#availableSeatingCapacityFilter'
  ).val();
  //alert(availableSeatingCapacityFilter);
  $.ajax({
    type: 'POST',
    url: './backScript.php',
    data: {
      AvailableCarsResponse: 'AvailableCarsResponse',
      City: City,
      ShowRows: ShowRows,
      availableCarsGroupFilter: availableCarsGroupFilter,
      seatingCapacity: availableSeatingCapacityFilter,
      availabilityFilter: availabilityFilter,
    },
    success: function (response) {
      $('.AvailableCarsResponse').html(response);
    },
  });
}

// Available CarsResponse
function viewCarDetails(vehicleNo) {
  $('.ajax-main-content').html(
    '<img src="./assets/images/loging.gif" style="width:100%;"/>'
  );
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
