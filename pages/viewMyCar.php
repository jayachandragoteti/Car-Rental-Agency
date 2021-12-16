<?php 
if (isset($_POST['viewCarDetails']) && isset($_POST['vehicleNo'])) {
	include "./../connect.php";
	session_start();
	$vehicleNo = $_POST['vehicleNo'];
	$selectCar = mysqli_query($connect,"SELECT * FROM `vehicleList` WHERE  `vehicleNo` = '$vehicleNo' ");
    $CarsRow=mysqli_fetch_array($selectCar);
	$userId = $CarsRow['userId'];
	$selectUser =  mysqli_query($connect,"SELECT * FROM `users` WHERE  `userId` = '$userId' ");
	$selectUserRow=mysqli_fetch_array($selectUser);
?>
<section>
	<div class="container mt-5">
		<div class="col-xl-12 pb-lg-5">
			<div class="card mb-4">
				<div class="card-header">Car Details</div>
				<div class="card-body">
					<div class="container">
						<div class="row justify-content-md-center">
							<div class="col-md-8"> <img class="img-account-profile mb-2 img-fluid img-thumbnail border  <?PHP echo ($CarsRow['VehicleStatus'] == 1) ? 'border-danger' : 'border-success' ;?>" src="./assets/images/vehicleImages/<?PHP echo $CarsRow['vehicleImage'];?>" alt="" style="width:80%;height:25rem;"/> </div>
							<div class="col-sm-4" style="margin-left:-1%;">
								<form id="carBooking">
									<div class="form-group mb-3">
										<label>Vehicle No :</label>
										<input class="form-control border-0" value="<?PHP echo $CarsRow['vehicleNo'];?>" disabled/> </div>
									<div class="form-group mb-3">
										<label>Vehicle Model :</label>
										<input class="form-control border-0" value="<?PHP echo $CarsRow['vehicleModel'];?>" disabled/> </div>
									<div class="form-group mb-3">
										<label>Seating Capacity :</label>
										<input class="form-control border-0" value="<?PHP echo $CarsRow['seatingCapacity'];?>" disabled/> </div>
									<div class="form-group mb-3">
										<label>Rent Per Day :</label>
										<input class="form-control border-0" value="<?PHP echo $CarsRow['rentPerDay'];?>" disabled/> </div>
									<?PHP if (isset($_SESSION['Customer']) && $CarsRow['VehicleStatus'] == '0') {?>
										<div class="form-group mb-3">
											<label for="noDaysToRent">No Days To Rent</label>
											<select class="form-control" id="noDaysToRent">
												<option value="">-------- Select No Days --------</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
											</select>
										</div>
										
										<div class="form-group mb-3">
											<label for="startingDate">Starting Date</label>
											<input type="date" class="form-control" id="startingDate" /> </div>
										<div class="form-group mb-3">
											<label class="book-your-car-alerts"></label>
											<input type="button"  onclick="bookYourCar('<?PHP echo $CarsRow['vehicleNo'];?>')" class="form-control btn btn-warning text-white" value="Rent Car" /> </div>
										<?PHP }elseif (isset($_SESSION['Customer']) && $CarsRow['VehicleStatus'] == '1'){
											?>
											<div class="form-group mt-lg-5">
												<input type="button"  class="form-control btn btn-danger text-white mt-lg-2" value="Booked" /> 
											</div>
										<? }else{?>
											<div class="form-group mt-lg-5">
												<input type="button" onclick="ajaxLoginPageCall()" class="form-control btn btn-warning text-white mt-lg-2" value="Rent Car" /> 
											</div>
										<?PHP }?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-12 pb-lg-5">
			<div class="mb-4">
				<div class="card mb-4">
					<div class="container">
						<div class="row justify-content-md-center">
							<div class="col-md-8 p-3">
								<div class="">Rental Agency Details</div> <img class="mb-2 img-fluid img-thumbnail" src="./assets/images/profilePics/<?PHP echo ($selectUserRow['profileImage'] == "") ? 'logo.png': $selectUserRow['profileImage'];?>" alt="" style="width:80%;height:25rem;"/> </div>
							<div class="col-sm-4 p-3">
								<form>
									<div class="form-group mb-3">
										<label>Agency Name :</label>
										<input class="form-control border-0 " value="<?PHP echo $selectUserRow['name'];?>" disabled/> </div>
									<div class="form-group mb-3">
										<label>Agency Email :</label>
										<input class="form-control border-0" value="<?PHP echo $selectUserRow['email'];?>" disabled/> </div>
									<div class="form-group mb-3">
										<label>Agency Contact No :</label>
										<input class="form-control border-0" value="<?PHP echo $selectUserRow['contactNo'];?>" disabled/> </div>
									<div class="form-group mb-3">
										<label>Agency Address :</label>
										<input class="form-control border-0" value="<?PHP echo $selectUserRow['address'];?>" disabled/> </div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?PHP }?>
