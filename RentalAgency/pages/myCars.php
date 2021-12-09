<?PHP 
include_once "./../../connect.php";
session_start();
if (isset($_SESSION['RentalAgency'])) {

?>
<section>
	<div class="container-fluid px-4">
		<h1 class="mt-4">My Cars</h1>
		<div class="row ">
			<div class="col-xl-12">
				<div class="card mb-4">
					<div class="card mb-4">
						<div class="card-header">
							<div class="dataTable-top">
								<div class="dataTable-dropdown">
									<label>
										<select class="dataTable-selector" id="ShowRows" onclick="myCarsList()">
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
												<th><a href="#" class="">Vehicle Image</a></th>
												<th><a href="#" class="">Vehicle No</a></th>
												<th><a href="#" class="">Vehicle Model</a></th>
												<th><a href="#" class="">Seating Capacity</a></th>
												<th><a href="#" class="">Rent Per Day</a></th>
												<th><a href="#" class="">Status</a></th>
												<th><a href="#" class="">View</a></th>
												<th><a href="#" class="">Delete</a></th>
											</tr>
										</thead>
										<tbody class="my-cars-list-data searchTable"> </tbody>
									</table>
								</div>
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