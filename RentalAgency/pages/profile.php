<?PHP 
include_once "./../../connect.php";
session_start();
if (isset($_SESSION['RentalAgency'])) {
	$RentalAgency = $_SESSION['RentalAgency'];
	$selectRentalAgency = mysqli_query($connect,"SELECT * FROM `users` WHERE `userId` = '$RentalAgency'");
	$selectRentalAgencyRow = mysqli_fetch_array($selectRentalAgency);
?>
<section>
	<div class="container-fluid px-4">
		<h1 class="mt-4">Profile</h1>
		<div class="row">
			<div class="col-xl-12">
				<div class="card mb-4">
					<div class="card-header"> Profile Details</div>
					<div class="card-body">
						<div class="row justify-content-md-center ">
							<div class="col-sm-6 border-bottom ">
								<div class="d-flex align-items-start py-3 p-lg-4 d-flex align-items-center"> <img src="./../assets/images/profilePics/<?PHP echo ($selectRentalAgencyRow['profileImage'] == "") ? 'logo.png': $selectRentalAgencyRow['profileImage'];?>" class="profileImage rounded-circle ml-lg-5" alt="" style="height:10rem;width:10rem;"> 
							</div>
							<span class="update-profile-data-Alerts"></span>
							</div>
							<div class="col-sm-6 border-bottom ">
								<div class="row py-2">
									<div class="pl-sm-4 pl-2 p-lg-4 " id="img-section"> <b>Profile Photo</b>
										<p>Accepted file type .jpeg, .jpg, .png, .gif, .jfif. Less than 5MB</p>
										<form id="updateProfilePicForm">
											<div class="row py-2">
												<div class="col-md-8">
													<label for="RentalAgencyProfilePic" class="form-label">Profile Pic</label>
													<input type="file" name="RentalAgencyProfilePic" class="form-control border-warning  shadow-none" id="RentalAgencyProfilePic" required/> </div>
												<div class="col-md-4 pt-3">
													<input type="button" onclick="profilePicUpdate()" name="updateProfilePic" id="updateProfilePic" class="form-control btn btn-warning mt-3 text-white" Value="Upload" /> </div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="row justify-content-md-center ">
							<div class="col-sm-12">
								<form id="updateProfileDataForm">
									<div class="row py-2">
										<div class="col-md-6">
											<label for="RentalAgencyName" class="form-label">Name</label>
											<input type="text" class="form-control border-warning  shadow-none" value="<?PHP echo $selectRentalAgencyRow['name']; ?>" name="RentalAgencyName" id="RentalAgencyName" required/> </div>
										<div class="col-md-6 pt-md-0 pt-3">
											<label for="RentalAgencyEmail" class="form-label">Email</label>
											<input type="email" name="RentalAgencyEmail" class="form-control border-warning  shadow-none" value="<?PHP echo $selectRentalAgencyRow['email']; ?>" id="RentalAgencyEmail" /> </div>
									</div>
									<div class="row py-2">
										<div class="col-md-6">
											<label for="RentalAgencyContactNo" class="form-label">Contact No</label>
											<input type="phone" name="RentalAgencyContactNo" class="form-control border-warning  shadow-none" value="<?PHP echo $selectRentalAgencyRow['contactNo']; ?>" id="RentalAgencyContactNo" required/> </div>
										<div class="col-md-6 pt-md-0 pt-3">
											<label for="RentalAgencyCity" class="form-label">City</label>
											<input type="text" name="RentalAgencyCity" class="form-control border-warning  shadow-none" value="<?PHP echo $selectRentalAgencyRow['city']; ?>" id="RentalAgencyCity" required/> </div>
									</div>
									<div class="row py-2">
										<div class="col-md-6">
											<label for="RentalAgencyAddress" class="form-label">Address</label>
											<input type="text" name="RentalAgencyAddress" class="form-control border-warning  shadow-none" value="<?PHP echo $selectRentalAgencyRow['address']; ?>" id="RentalAgencyAddress" required/> </div>
										<div class="col-md-6 pt-3">
											<input type="button" onclick="updateProfileData()" class="form-control btn btn-warning mt-3 text-white" Value="Save Changes" /> </div>
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
