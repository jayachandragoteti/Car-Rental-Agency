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
		<h1 class="mt-4">Dashboard</h1>
		<div class="row justify-content-md-center">
			<div class="col-xl-3 col-md-6">
				<div class="card bg-primary text-white mb-4">
					<div class="card-body h3">
						<?PHP 
							$selectTotalCars = mysqli_fetch_array(mysqli_query($connect,"SELECT COUNT(`vehicleNo`) AS `carCount` FROM `vehicleList` WHERE `userId` = '$RentalAgency'"));
							echo $selectTotalCars['carCount'];
						?>
					</div>
					<div class="card-footer d-flex align-items-center justify-content-between">
						<div class="small text-white"> Total Cars </div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="card bg-warning text-white mb-4">
					<div class="card-body h3">
						<?PHP 
							$selectTotalBookings = mysqli_fetch_array(mysqli_query($connect,"SELECT COUNT(`vehicleNo`) AS `bookingCount` FROM `carBookings` WHERE `vehicleNo` IN (SELECT `vehicleNo` FROM `vehicleList` WHERE `userId` = '$RentalAgency')"));
							echo $selectTotalBookings['bookingCount'];
						?>
					</div>
					<div class="card-footer d-flex align-items-center justify-content-between">
						<div class="small text-white"> Total No Of Bookings </div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="card bg-success text-white mb-4">
					<div class="card-body h3">
						<?PHP 
							$selectTotalBooked = mysqli_fetch_array(mysqli_query($connect,"SELECT COUNT(`vehicleNo`) AS `bookedCount` FROM `vehicleList` WHERE `VehicleStatus` = '1' AND `userId` = '$RentalAgency'"));
							echo $selectTotalBooked['bookedCount'];
						?>
					</div>
					<div class="card-footer d-flex align-items-center justify-content-between">
						<div class="small text-white"> Present Booked Cars </div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-12">
				<div class="card mb-4">
					<div class="card-header"> Booking Requests <span class="Booking-requests-data-Alerts"></span>
						<div class="dataTable-top">
							<div class="dataTable-dropdown">
								<label>
									<select class="dataTable-selector" id="ShowRows" onchange="bookingRequests()">
									<option value="10">10</option>
									<option value="20">20</option>
									<option value="30">30</option>
									<option value="40">40</option>
									<option value="50">50</option>
									<option value="60">60</option>
									<option value="70">70</option>
									<option value="80">80</option>
									<option value="90">90</option>
									<option value="100">100</option>
									<option value="More">More</option>
									</select></label>
							</div>
							<div class="dataTable-search col-5">
								<input class="dataTable-input searchInput" placeholder="Search..." type="text"> </div>
						</div>
					</div>
					<div class="card-body">
						<div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
							<div class="dataTable-container">
								<table id="datatablesSimple" class="dataTable-table">
									<thead>
										<tr>
											<th><a href="#" class="">#</a></th>
											<th><a href="#" class="">Booking Id</a></th>
											<th><a href="#" class="">Vehicle No</a></th>
											<th><a href="#" class="">No Days</a></th>
											<th><a href="#" class="">Starting Date</a></th>
											<th><a href="#" class="">View Customer</a></th>
											<th><a href="#" class="">Accept</a></th>
											<th><a href="#" class="">Delete</a></th>
										</tr>
									</thead>
									<tbody class="booked-cars-list-data searchTable"> </tbody>
								</table>
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
<script>
	// Jquery search
$('.searchInput').on('keyup', function () {
  var value = $(this).val().toLowerCase();
  $('.searchTable tr').filter(function () {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
  });
});
</script>