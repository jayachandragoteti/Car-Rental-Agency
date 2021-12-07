<?php
include_once "./connect.php";
session_start();
// RentalAgency Registration
if (isset($_POST['RentalAgencyName']) && isset($_POST['RentalAgencyEmail']) && isset($_POST['RentalAgencyContactNo']) && isset($_POST['RentalAgencyAddress']) && isset($_POST['RentalAgencyRegistrationNo']) && isset($_POST['RentalAgencyPassword']) && isset($_POST['RentalAgencyConfirmPassword']) && $_FILES['RentalAgencyDocument']) {
    if ($_POST['RentalAgencyName'] != "" &&  $_POST['RentalAgencyEmail'] != "" && $_POST['RentalAgencyContactNo'] != "" && $_POST['RentalAgencyAddress'] != "" && $_POST['RentalAgencyRegistrationNo'] != "" && $_POST['RentalAgencyPassword'] != "" && $_POST['RentalAgencyConfirmPassword'] != "" && $_FILES['RentalAgencyDocument']) {
        $RentalAgencyName = $connect -> real_escape_string($_POST['RentalAgencyName']);
        $RentalAgencyEmail = $connect -> real_escape_string($_POST['RentalAgencyEmail']);
        $RentalAgencyContactNo = $connect -> real_escape_string($_POST['RentalAgencyContactNo']);
        $RentalAgencyAddress = $connect -> real_escape_string($_POST['RentalAgencyAddress']);
        $RentalAgencyRegistrationNo = $connect -> real_escape_string($_POST['RentalAgencyRegistrationNo']);
        $RentalAgencyPassword = $connect -> real_escape_string($_POST['RentalAgencyPassword']);
        $RentalAgencyConfirmPassword = $connect -> real_escape_string($_POST['RentalAgencyConfirmPassword']);
        $RentalAgencyDocumentName = $_FILES['RentalAgencyDocument']['name'];
        $RentalAgencyDocumentFile = $_FILES['RentalAgencyDocument']['tmp_name'];
        //echo $RentalAgencyName.$RentalAgencyEmail.$RentalAgencyContactNo.$RentalAgencyAddress.$RentalAgencyRegistrationNo.$RentalAgencyPassword.$RentalAgencyConfirmPassword.$RentalAgencyDocumentName;
        $userCheck = mysqli_query($connect,"SELECT * FROM `users` WHERE `users`.`email` = '$RentalAgencyEmail'");
        if (mysqli_num_rows($userCheck) == 0) {
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'JPEG' , 'PNG' , 'JPG' , 'jfif');
            $path = './assets/images/Documents/';
            $ext = strtolower(pathinfo($RentalAgencyDocumentName, PATHINFO_EXTENSION));
            $finalImage = strtolower($RentalAgencyName.$RentalAgencyEmail.".".$ext);
            $path1 = $path.($finalImage);
            if ($RentalAgencyPassword != $RentalAgencyConfirmPassword) {
                echo "Password and confirm password should be same.";
            } elseif(!in_array($ext, $valid_extensions)){
                echo "Images extension can be 'jpeg', 'jpg', 'png', 'gif', 'JPEG' , 'PNG' , 'JPG' , 'jfif'";
            } elseif($_FILES['RentalAgencyDocument']['size'] > 5097152){
                echo "Image size must be exactly 5MB or below.";
            } elseif (move_uploaded_file($RentalAgencyDocumentFile,$path1)) {//
                $hashed_password = password_hash($RentalAgencyPassword, PASSWORD_DEFAULT);
                $RentalAgencyRegister = mysqli_query($connect,"INSERT INTO `users`(`name`, `email`, `contactNo`, `address`, `AadharNoOrAgencyRegistrationNo`, `document`, `password`, `loginType`) VALUES ('$RentalAgencyName','$RentalAgencyEmail','$RentalAgencyContactNo','$RentalAgencyAddress','$RentalAgencyRegistrationNo','$finalImage','$hashed_password','0')") or mysqli_error($connect);
                if ($RentalAgencyRegister) {
                    echo "Rental Agency successfully registered.";
                }else {
                    unlink("./assets/images/Documents/$finalImage");
                    echo "failed, Try Again!";
                }
            }else {
                echo $finalImage;
                echo "Document is not uploaded.Try Again!";
            }
        } else {
            echo "User already exists!";
        }
        
    } else {
        echo "All fields must be filled!";
    }
}

// Customer Registration
if (isset($_POST['CustomersName']) && isset($_POST['CustomersEmail']) && isset($_POST['CustomersContactNo']) && isset($_POST['CustomersAddress']) && isset($_POST['AadharNumber']) && isset($_POST['CustomersPassword']) && isset($_POST['CustomersConfirmPassword']) && $_FILES['CustomersDocument']) {
    if ($_POST['CustomersName'] != "" &&  $_POST['CustomersEmail'] != "" && $_POST['CustomersContactNo'] != "" && $_POST['CustomersAddress'] != "" && $_POST['AadharNumber'] != "" && $_POST['CustomersPassword'] != "" && $_POST['CustomersConfirmPassword'] != "" && $_FILES['CustomersDocument']) {
        $CustomersName = $connect -> real_escape_string($_POST['CustomersName']);
        $CustomersEmail = $connect -> real_escape_string($_POST['CustomersEmail']);
        $CustomersContactNo = $connect -> real_escape_string($_POST['CustomersContactNo']);
        $CustomersAddress = $connect -> real_escape_string($_POST['CustomersAddress']);
        $AadharNumber = $connect -> real_escape_string($_POST['AadharNumber']);
        $CustomersPassword = $connect -> real_escape_string($_POST['CustomersPassword']);
        $CustomersConfirmPassword = $connect -> real_escape_string($_POST['CustomersConfirmPassword']);
        $CustomersDocumentName = $_FILES['CustomersDocument']['name'];
        $CustomersDocumentFile = $_FILES['CustomersDocument']['tmp_name'];
        //echo $CustomersName.$CustomersEmail.$CustomersContactNo.$CustomersAddress.$AadharNumber.$CustomersPassword.$CustomersConfirmPassword.$CustomersDocumentName;
        $userCheck = mysqli_query($connect,"SELECT * FROM `users` WHERE `users`.`email` = '$CustomersEmail'");
        if (mysqli_num_rows($userCheck) == 0) {
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'JPEG' , 'PNG' , 'JPG' , 'jfif');
            $path = './assets/images/Documents/';
            $ext = strtolower(pathinfo($CustomersDocumentName, PATHINFO_EXTENSION));
            $finalImage = strtolower($CustomersName.$CustomersEmail.".".$ext);
            $path1 = $path.($finalImage);
            if ($CustomersPassword != $CustomersConfirmPassword) {
                echo "Password and confirm password should be same.";
            } elseif(!in_array($ext, $valid_extensions)){
                echo "Images extension can be 'jpeg', 'jpg', 'png', 'gif', 'JPEG' , 'PNG' , 'JPG' , 'jfif'";
            } elseif($_FILES['CustomersDocument']['size'] > 5097152){
                echo "Image size must be exactly 5MB or below.";
            } elseif (move_uploaded_file($CustomersDocumentFile,$path1) or 1) {
                $hashed_password = password_hash($CustomersPassword, PASSWORD_DEFAULT);
                $CustomersRegister = mysqli_query($connect,"INSERT INTO `users`( `name`, `email`, `contactNo`, `address`, `AadharNoOrAgencyRegistrationNo`, `document`, `password`, `loginType`) VALUES ('$CustomersName','$CustomersEmail','$CustomersContactNo','$CustomersAddress','$AadharNumber','$finalImage','$hashed_password','1')");
                if ($CustomersRegister) {
                    echo "Rental Agency successfully registered.";
                }else {
                    unlink("./assets/images/Documents/$finalImage");
                    echo "failed, Try Again!";
                }
            }else {
                echo $finalImage;
                echo "Document is not uploaded.Try Again!";
            }
        } else {
            echo "User already exists!";
        }
        
    } else {
        echo "All fields must be filled!";
    }
}

// User Login
if(isset($_POST['UserLogin'])){
	if (!isset($_POST['loginEmail']) || $_POST['loginEmail'] == "" || !isset($_POST['loginPassword']) || $_POST['loginPassword'] == "" ) {
		echo "All fields must be filled!";
	} else {
		$loginEmail = $connect -> real_escape_string($_POST['loginEmail']);
		$loginPassword = $connect -> real_escape_string($_POST['loginPassword']);
		// Login Type Check
        $searchUser = mysqli_query($connect,"SELECT * FROM `users` WHERE `email` = '$loginEmail'");
		if (mysqli_num_rows($searchUser) == 1) {
			$searchUserRow = mysqli_fetch_array($searchUser);
			// If the password inputs matched the hashed password in the database
			if (password_verify($loginPassword, $searchUserRow['password'])) {
                
                if ($searchUserRow['loginType'] == "0") {
                    //session_start();
                    $_SESSION['RentalAgency'] = $searchUserRow['userId'];
                    echo "loggedSuccessfully";
                }elseif ($searchUserRow['loginType'] == "1") {
                    //session_start();
                    $_SESSION['Customer'] = $searchUserRow['userId'];
                    echo "loggedSuccessfully";
                } 
                else {
                    echo "login failed, try again!";
                }
			}else{
				echo "Invalid Password!";
			}
		} else {
			echo "Invalid login!";
        }
	}
}
