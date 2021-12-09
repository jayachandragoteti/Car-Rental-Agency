<?PHP 
include_once "./../connect.php";
session_start();
if (isset($_SESSION['Customer'])) {
	$Customer = $_SESSION['Customer'];
	$selectCustomer = mysqli_query($connect,"SELECT * FROM `users` WHERE `userId` = '$Customer'");
	$selectCustomerRow = mysqli_fetch_array($selectCustomer);
?>
<section>
	<div class="container mt-lg-5" style="margin-top:5rem;">
		<div class="row justify-content-md-center">
			<!-- justify-content-md-center -->
			<div class="col-lg-8">
				<div class="card shadow mb-4">
					<div class="card-header py-3 text-center text-warning">
						<h4>Profile</h4> 
					</div>
					<div class="card">
						<div class="container">
							<div class="row justify-content-md-center">
								<div class="col-sm-6">
									<div class="d-flex align-items-start py-3 border-bottom p-lg-4"> <img src="./assets/images/profilePics/<?PHP echo ($selectCustomerRow['profileImage'] == "") ? 'profile.png': $selectCustomerRow['profileImage'];?>" class="profileImage rounded-circle ml-lg-5" alt=""> </div>
								</div>
								<div class="col-sm-6">
									<div class="row py-2">
										<div class="pl-sm-4 pl-2 p-lg-4 " id="img-section"> <b>Profile Photo</b>
											<p>Accepted file type .jpeg, .jpg, .png, .gif, .jfif. Less than 5MB</p>
											<form id="updateProfilePicForm">
												<div class="row py-2">
													<div class="col-md-8">
														<label for="CustomersProfilePic" class="form-label">Profile Pic</label>
														<input type="file" name="CustomersProfilePic" class="form-control border-warning  shadow-none" id="CustomersProfilePic" required/> </div>
													<div class="col-md-4 pt-3">
														<input type="button" onclick="profilePicUpdate()" name="updateProfilePic" id="updateProfilePic"class="form-control btn btn-warning mt-3 text-white" Value="Upload" /> </div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="row justify-content-md-center pb-lg-5">
								<p class="update-profile-data-Alerts"></p>
								<form id="updateProfileDataForm">
									<div class="row py-2">
										<div class="col-md-6">
											<label for="CustomersName" class="form-label">Name</label>
											<input type="text" class="form-control border-warning  shadow-none" value="<?PHP echo $selectCustomerRow['name']; ?>" name="CustomersName" id="CustomersName" required/> </div>
										<div class="col-md-6 pt-md-0 pt-3">
											<label for="CustomersEmail" class="form-label">Email</label>
											<input type="email" name="CustomersEmail" class="form-control border-warning  shadow-none" value="<?PHP echo $selectCustomerRow['email']; ?>" id="CustomersEmail"/> </div>
									</div>
									<div class="row py-2">
										<div class="col-md-6">
											<label for="CustomersContactNo" class="form-label">Contact No</label>
											<input type="phone" name="CustomersContactNo" class="form-control border-warning  shadow-none" value="<?PHP echo $selectCustomerRow['contactNo']; ?>"id="CustomersContactNo" required/> </div>
										<div class="col-md-6 pt-md-0 pt-3">
											<label for="CustomersCity" class="form-label">City</label>
											<input type="text" name="CustomersCity" class="form-control border-warning  shadow-none" value="<?PHP echo $selectCustomerRow['city']; ?>" id="CustomersCity" required/> </div>
									</div>
									<div class="row py-2">
										<div class="col-md-6">
											<label for="CustomersAddress" class="form-label">Address</label>
											<input type="text" name="CustomersAddress" class="form-control border-warning  shadow-none" value="<?PHP echo $selectCustomerRow['address']; ?>" id="CustomersAddress" required/> </div>
										<div class="col-md-6 pt-3">
											<input type="button" onclick="updateProfileData()"class="form-control btn btn-warning mt-3 text-white" Value="Save Changes" /> </div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?PHP 
}
?>