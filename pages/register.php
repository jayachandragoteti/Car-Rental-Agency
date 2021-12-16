
<section>
    
    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-md-center shift-register">
                        <div class="col-lg-4">
                            <button class="btn btn-sm btn-warning  rounded-pill fw-bold RentalAgencyRegistrationButton text-wh" >Rental Agency</button>
                        </div>
                        <div class="col-lg-4">
                            <button class="btn btn-sm btn-warning  rounded-pill fw-bold CustomersRegistrationButton bg-light border-warning  text-warning ">Customers</button>
                        </div>
                    </div>
                    <div class="container mt-5 z-index">
                        <div class="row mt-5 RentalAgencyRegistrationForm">
                            <div class="col-lg-12">
                                <h2 class="text-center mb-5 text-warning ">Rental Agency Registration</h2>
                            </div>
                            <div class="col-sm-6"> <img src="./assets/images/rentalAgency.png" class="img-fluid mt-5 h-75 w-100" alt="Rental Agency Registration"> </div>
                            <div class="col-sm-6">
                                <form id="RentalAgencyRegistrationForm" class="md-5">
                                    <div class="mb-3">
                                        <label for="RentalAgencyName" class="form-label">Rental Agency Name</label>
                                        <input type="text" class="form-control border-warning  shadow-none" name="RentalAgencyName" id="RentalAgencyName" required/> 
                                    </div>
                                    <div class="mb-3">
                                        <label for="RentalAgencyEmail" class="form-label">Email</label>
                                        <input type="email" name="RentalAgencyEmail" class="form-control border-warning  shadow-none" id="RentalAgencyEmail" required/> 
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="RentalAgencyContactNo" class="form-label">Contact No</label>
                                        <input type="phone" name="RentalAgencyContactNo" class="form-control border-warning  shadow-none" id="RentalAgencyContactNo" required/> 
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="RentalAgencyAddress" class="form-label">Address</label>
                                        <input type="text" name="RentalAgencyAddress" class="form-control border-warning  shadow-none" id="RentalAgencyAddress" required/> 
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="RentalAgencyCity" class="form-label">City</label>
                                        <input type="text" name="RentalAgencyCity" class="form-control border-warning  shadow-none" id="RentalAgencyCity" required/> 
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="RentalAgencyRegistrationNo" class="form-label">Agency Registration No</label>
                                        <input type="text" name="RentalAgencyRegistrationNo" class="form-control border-warning  shadow-none" id="RentalAgencyRegistrationNo" required/> 
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="RentalAgencyDocument" class="form-label">Agency Registration Document</label>
                                        <input type="file" name="RentalAgencyDocument" class="form-control border-warning  shadow-none" id="RentalAgencyDocument" required/> 
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="RentalAgencyPassword" class="form-label">Password</label>
                                        <input type="password" name="RentalAgencyPassword" class="form-control border-warning  shadow-none" id="RentalAgencyPassword" required/> 
                                    </div>
                                    <div class="mb-3">
                                        <label for="RentalAgencyConfirmPassword" class="form-label">Confirm password</label>
                                        <input type="password" name="RentalAgencyConfirmPassword" class="form-control border-warning  shadow-none" id="RentalAgencyConfirmPassword" required/> 
                                    </div>
                                    <p class="fw-bold text-warning"> <span class="RentalAgency-Registration-Alerts"></span></p>
                                    <div class=" mb-3 text-center">
                                        <input type="button" class="btn btn-sm btn-warning  text-white  rounded-pill" name="RentalAgencyRegistration" id="RentalAgencyRegistration" onclick="rentalAgencyRegistration()" style="font-size:20px;" value="Register" /> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--======================Customers registration================================-->
                    <div class="container mt-5 CustomersRegistrationForm" style="display: none;">
                        <div class="row mt-5 ">
                            <div class="col-lg-12">
                                <h2 class="text-center mb-5 text-warning ">Customers Registration</h2> </div>
                            <div class="col-sm-6">
                                <img src="./assets/images/customer.png" class="img-fluid mt-5 h-75 w-100" alt="Customers Registration">
                            </div>
                            <div class="col-sm-6">
                                <form id="CustomersRegistrationForm" class="md-5">
                                    <div class="mb-3">
                                        <label for="CustomersName" class="form-label">Name</label>
                                        <input type="text" class="form-control border-warning  shadow-none" name="CustomersName" id="CustomersName" required/> 
                                    </div>
                                    <div class="mb-3">
                                        <label for="CustomersEmail" class="form-label">Email</label>
                                        <input type="email" name="CustomersEmail" class="form-control border-warning  shadow-none" id="CustomersEmail" required/> 
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="CustomersContactNo" class="form-label">Contact No</label>
                                        <input type="phone" name="CustomersContactNo" class="form-control border-warning  shadow-none" id="CustomersContactNo" required/> 
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="CustomersCity" class="form-label">City</label>
                                        <input type="text" name="CustomersCity" class="form-control border-warning  shadow-none" id="CustomersCity" required/> 
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="CustomersAddress" class="form-label">Address</label>
                                        <input type="text" name="CustomersAddress" class="form-control border-warning  shadow-none" id="CustomersAddress" required/> 
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="AadharNumber" class="form-label">Aadhar Numbers</label>
                                        <input type="text" name="AadharNumber" class="form-control border-warning  shadow-none" id="AadharNumber" required/> 
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="CustomersDocument" class="form-label">Aadhar Document </label>
                                        <input type="file" name="CustomersDocument" class="form-control border-warning  shadow-none" id="CustomersDocument" required/> 
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="CustomersPassword" class="form-label">Password</label>
                                        <input type="password" name="CustomersPassword" class="form-control border-warning  shadow-none" id="CustomersPassword" required/> 
                                    </div>
                                    <div class="mb-3">
                                        <label for="CustomersConfirmPassword" class="form-label">Confirm password</label>
                                        <input type="password" name="CustomersConfirmPassword" class="form-control border-warning  shadow-none" id="CustomersConfirmPassword" required/> 
                                    </div>
                                    <p class="fw-bold text-warning"> <span class="Customers-Registration-Alerts"></span></p>
                                    <div class=" mb-3 text-center">
                                        <input type="button" class="btn btn-sm btn-warning  text-white  rounded-pill" name="CustomersRegistration" id="CustomersRegistration" onclick="customersRegistration()" style="font-size:20px;" value="Register" /> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--======================End Customers registration================================-->
                    
                </div>
            </div>
        </div>
    </div>   
</section>
<script>
    $('.RentalAgencyRegistrationButton').click(function () {
        $('.RentalAgencyRegistrationButton').removeClass('bg-light border-warning  text-warning');
        $('.CustomersRegistrationButton').addClass('bg-light border-warning  text-warning');
        $('.RentalAgencyRegistrationForm').show();
        $('.CustomersRegistrationForm').hide();
        //   $('.RentalAgencyRegistrationButton').prop('disabled', true);
        //   $('.CustomersRegistrationButton').prop('disabled', false);
    });

    $('.CustomersRegistrationButton').click(function () {
        $('.CustomersRegistrationForm').show();
        $('.RentalAgencyRegistrationForm').hide();
        $('.RentalAgencyRegistrationButton').addClass('bg-light border-warning  text-warning ');
        $('.CustomersRegistrationButton').removeClass('bg-light border-warning  text-warning ');
        //   $('.RentalAgencyRegistrationButton').prop('disabled', false);
        //   $('.CustomersRegistrationButton').prop('disabled', true);
    });
</script>