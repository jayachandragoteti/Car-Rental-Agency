<?php
//include "connect.php";
$connect =  mysqli_connect("localhost","root", "","carRentalAgency");
if (isset($_POST['vehicleNo']) && isset($_POST['vehicleModel']) && isset($_POST['seatingCapacity']) && isset($_POST['rentPerDay']) && $_FILES['vehicleImage']) {
    if ($_POST['vehicleNo'] != "" && $_POST['vehicleModel'] !="" && $_POST['seatingCapacity'] !="" && $_POST['rentPerDay'] !="" )  {
        $vehicleNo = $connect->real_escape_string($_POST['vehicleNo']);
        $vehicleModel = $connect->real_escape_string($_POST['vehicleModel']);
        $seatingCapacity = $connect->real_escape_string($_POST['seatingCapacity']);
        $rentPerDay = $connect->real_escape_string($_POST['rentPerDay']);
        // ------------
        // $vehicleImage = $_FILES['vehicleImage']['name'];
        // $vehicleImageFile = $_FILES['vehicleImage']['tmp_name'];
        // $$vehicleImageExt = strtolower(pathinfo($vehicleImage, PATHINFO_EXTENSION));

        // $trainingOutcomeName = strtolower($vehicleNo. $$vehicleImageExt);
        // $trainingOutcomePath = "./" . ($trainingOutcomeName);
        // $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'JPEG', 'PNG', 'JPG', 'jfif');
        // $path = './assets/';//$target_dir = "uploads/";
        // $target_file = $path . basename($_FILES['vehicleImage']['name']);

        // if (file_exists($target_file)) {
        //     echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Sorry, file already exists.</p>';
        // }elseif ($_FILES["vehicleImage"]["size"] > 300000) {
        //     echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Sorry, Image size must be exactly 3MB or below.</p>';
        // }elseif (!in_array($$vehicleImageExt, $valid_extensions)) {
        //     echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Sorry, mages extension can be "jpeg", "jpg", "png", "gif", "JPEG" , "PNG" , "JPG" , "jfif"</p>';
        // }elseif (move_uploaded_file($_FILES["vehicleImage"]["tmp_name"], $target_file)) {
        //     echo '<p class="text-success"><i class="fas fa-circle"></i> Done.</p>';
        // }else {
        //     echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Sorry, file is not uploaded.Try Again!.</p>';
        // }
    } else {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> All fields must be filled</p>';
    }
    
}