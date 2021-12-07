<?php
include "./../connect.php";
session_start();

//$connect =  mysqli_connect("localhost","root", "","carRentalAgency");
if (isset($_POST['vehicleNo']) && isset($_POST['vehicleModel']) && isset($_POST['seatingCapacity']) && isset($_POST['rentPerDay']) && $_FILES['vehicleImage']) {
    if ($_POST['vehicleNo'] != "" && $_POST['vehicleModel'] !="" && $_POST['seatingCapacity'] !="" && $_POST['rentPerDay'] !="" )  {
        $vehicleNo = $connect->real_escape_string($_POST['vehicleNo']);
        $vehicleModel = $connect->real_escape_string($_POST['vehicleModel']);
        $seatingCapacity = $connect->real_escape_string($_POST['seatingCapacity']);
        $rentPerDay = $connect->real_escape_string($_POST['rentPerDay']);
        // ------------
        $vehicleImage = $_FILES['vehicleImage']['name'];
        $vehicleImageFile = $_FILES['vehicleImage']['tmp_name'];
        $vehicleImageExt = strtolower(pathinfo($vehicleImage, PATHINFO_EXTENSION));

        $trainingOutcomeName = strtolower($vehicleNo. $vehicleImageExt);
        $trainingOutcomePath = "./" . ($trainingOutcomeName);
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'JPEG', 'PNG', 'JPG', 'jfif');
        $path = './../assets/images/vehicleImages/';//$target_dir = "uploads/";
        $finalImage = strtolower($vehicleNo.".".$vehicleImageExt);
        $target_file = $path .($finalImage);
        if (file_exists($target_file)) {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Sorry, file already exists.</p>';
        }elseif ($_FILES["vehicleImage"]["size"] > 300000) {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Sorry, Image size must be exactly 3MB or below.</p>';
        }elseif (!in_array($vehicleImageExt, $valid_extensions)) {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Sorry, mages extension can be "jpeg", "jpg", "png", "gif", "JPEG" , "PNG" , "JPG" , "jfif"</p>';
        }elseif (move_uploaded_file($_FILES["vehicleImage"]["tmp_name"],$target_file)) {
            $insertCar = mysqli_query($connect,"INSERT INTO `vehicleList`(`vehicleNo`, `vehicleModel`, `seatingCapacity`, `rentPerDay`, `vehicleImage`, `VehicleStatus`) VALUES ('$vehicleNo','$vehicleModel','$seatingCapacity','$rentPerDay ','$finalImage','1')");
            if ($insertCar) {
                echo '<p class="text-success"><i class="fas fa-circle"></i> Done.</p>';
            } else {
                unlink("./../assets/images/vehicleImages/$finalImage");
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Sorry, failed, Try Again!.</p>';
            }
            
            
        }else {
            echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Sorry, file is not uploaded.Try Again!.</p>';
        }
    } else {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> All fields must be filled</p>';
    }
    
}
// Update Password
if (isset($_POST['UpdatePassword']) && isset($_SESSION['RentalAgency'])) {
	if (isset($_POST['oldPassword']) && $_POST['oldPassword'] != "" && isset($_POST['newPassword']) && $_POST['newPassword'] != "" && isset($_POST['confirmPassword']) && $_POST['confirmPassword'] != "") {
		$RentalAgency = $_SESSION['RentalAgency'];
		$newPassword = $connect -> real_escape_string($_POST['newPassword']);
		$confirmPassword = $connect -> real_escape_string($_POST['confirmPassword']);
		if ($newPassword != $confirmPassword) {
			echo "Password and confirm password should be same!";
		}elseif (strlen($newPassword) < 8) {
			echo "Password should contain at least eight characters";
		} else {
			$selectRentalAgency = mysqli_query($connect,"SELECT * FROM `users` WHERE `userId` = '$RentalAgency'");
			if ($selectRentalAgency && mysqli_num_rows($selectRentalAgency) == 1 ) {
				$selectRentalAgencyRow = mysqli_fetch_array($selectRentalAgency);
				$oldPassword = $connect -> real_escape_string($_POST['oldPassword']);
				if (password_verify($oldPassword, $selectRentalAgencyRow['password'])) {
					$hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
					$updatePassword = mysqli_query($connect,"UPDATE `users` SET `password`='$hashed_password' WHERE `userId` = '$RentalAgency'");
					if ($updatePassword) {
                        echo '<p class="text-success"><i class="fas fa-circle"></i> Password Updated successfully.</p>';
					} else {
                        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed try again!</p>';
					}
				}else{
                    echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> All fields must be filled</p>';
				}
			} else {
				echo "";
                echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> Invalid login!</p>';
			}
		}
	} else {
        echo '<p class="text-danger"><i class="fas fa-exclamation-circle"></i> All fields must be filled!</p>';
	}
}
