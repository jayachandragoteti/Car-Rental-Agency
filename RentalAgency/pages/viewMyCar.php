<?php 
if (isset($_POST['viewMyCar']) && isset($_POST['carNumber'])) {
	include "./../../connect.php";
	session_start();
	$RentalAgency = $_SESSION['RentalAgency'];
	$carNumber = $_POST['carNumber'];
	$selectCar = mysqli_query($connect,"SELECT * FROM `vehicleList` WHERE `userId` = '$RentalAgency' AND `vehicleNo` = '$carNumber' ");
    $CarsRow=mysqli_fetch_array($selectCar);
?>
<section>
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-xl-4">
				<!-- Profile picture card-->
				<div class="card mb-4 mb-xl-0">
					<div class="card-header">Car Picture</div>
					<div class="card-body text-center"> <img class="img-fluid mb-2" src="./../assets/images/vehicleImages/<?PHP echo $CarsRow['vehicleImage'];?>" alt="">
						<div class="small font-italic text-muted mb-4 rental-agency-car-pic-update-alerts">JPG or PNG no larger than 5 MB</div>
						<form id="updateRentalAgencyCarPicForm">
							<div class="row py-2">
								<div class="col-md-12">
									<input type="file" name="RentalAgencyCarPic" class="form-control border-warning  shadow-none" id="RentalAgencyProfilePic" required/> 
                                    <input type="text" name="RentalAgencyCarNo" value="<?PHP echo $carNumber;?>" class="form-control border-warning  shadow-none" id="RentalAgencyProfileNo" hidden/>
                                </div>
								<div class="col-md-12 pt-3">
									<input type="button" onclick="rentalAgencyCarPicUpdate('<?PHP echo $carNumber;?>')" name="updateRentalAgencyCarPic" id="updateRentalAgencyCarPic" class="form-control btn btn-warning mt-3 text-white" Value="Upload" /> </div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-xl-8">
				<!-- Account details card-->
				<div class="card mb-4">
					<div class="card-header">Car Details</div>
					<div class="card-body">
						<form id="updateRentalAgencyCarDataForm">
							<!-- Form Group (-->
							<div class="mb-3">
								<label class="small mb-1" for="updateRentalAgencyCarNo">Vehicle No</label>
								<input class="form-control" id="updateRentalAgencyCarNo" name="updateRentalAgencyCarNo" value="<?PHP echo $CarsRow['vehicleNo'];?>" type="text" /> </div>
							<div class="mb-3">
								<label class="small mb-1" for="updateRentalAgencyCarModel">Vehicle Model</label>
								<input class="form-control" id="updateRentalAgencyCarModel" name="updateRentalAgencyCarModel" value="<?PHP echo $CarsRow['vehicleModel'];?>" type="text" /> </div>
							<div class="mb-3">
								<label class="small mb-1" for="updateRentalAgencyCarSeatingCapacity">Seating Capacity</label>
								<input class="form-control" id="updateRentalAgencyCarSeatingCapacity" name="updateRentalAgencyCarSeatingCapacity" value="<?PHP echo $CarsRow['seatingCapacity'];?>" type="number" /> </div>
							<div class="mb-3">
								<label class="small mb-1" for="updateRentalAgencyCarRentPerDay">Rent Per Day</label>
								<input class="form-control" id="updateRentalAgencyCarRentPerDay" name="updateRentalAgencyCarRentPerDay" value="<?PHP echo $CarsRow['rentPerDay'];?>" type="number" /> 
                                <input type="text" name="RentalAgencyCarNo" value="<?PHP echo $carNumber;?>" class="form-control border-warning  shadow-none" id="RentalAgencyProfileNo" hidden/>
                            </div>
							<!-- Save changes button-->
                            <div class="small font-italic text-muted mb-4 rental-agency-car-data-update-alerts"></div>
							<button class="btn btn-warning text-white" onclick="rentalAgencyCarDataUpdate('<?PHP echo $carNumber;?>')"type="button">Save changes</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?PHP }?>