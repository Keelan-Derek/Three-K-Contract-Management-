<?php
  session_start();
  require_once ('dbconnect.php');
  $connection = dbconnect();
  $userid = $_SESSION["user"];

  $_SESSION['alert']= "";

  $modalForm = "";

    if(isset($_POST["modalForm"])){
        $modalForm = $_POST["modalForm"];
    }

    if($modalForm == "addContractActivity"){
        $contractID =  mysqli_real_escape_string($connection, $_POST["contractID"]);
        $activityID = mysqli_real_escape_string($connection, $_POST["activityID"]);
        $activityName = mysqli_real_escape_string($connection, $_POST["activityName"]); 
        $activityDesc = mysqli_real_escape_string($connection, $_POST["activityDesc"]);
        $startDate = mysqli_real_escape_string($connection, $_POST["startDate"]);
        $finishDate = mysqli_real_escape_string($connection, $_POST["finishDate"]);
        $completionStatus = mysqli_real_escape_string($connection, $_POST["completionStatus"]);

        $query = "INSERT INTO contract_activities (activityID, contractID, activityName, activityDesc, startDate, finishDate, completionStatus) 
                VALUES('$activityID', '$contractID', '$activityName', '$activityDesc', '$startDate', '$finishDate', '$completionStatus')";
        $ret = mysqli_query($connection, $query);
        if ($ret) {
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['alert'] = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Contract Activity succesfully added.</span></div>';
        } else {
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error:' . mysqli_error($connection) . '</div>';
        } 
    }else if($modalForm =="addDocument"){
        $contractID = mysqli_real_escape_string($connection, $_POST["contractID"]);

        $countfiles = count($_FILES['upload']['name']);

        for($i = 0; $i < $countfiles; $i++){
            $fileName = $_FILES['upload']['name'][$i];
            $file = $_FILES['upload']['tmp_name'][$i];
            $fileSize = $_FILES['upload']['size'][$i];
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        }

        $path = 'uploads/' . $fileName;

        if(move_uploaded_file($file, $path)){
            $query = "INSERT INTO uploads(contractID, fileName, fileType, fileSize) VALUES ('$contractID', '$fileName', '$fileType', '$fileSize')";
            $ret = mysqli_query($connection, $query);
        }
        

        if ($ret) {
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['alert'] = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Contract Document succesfully uploaded.</span></div>';
        } else {
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error:' . mysqli_error($connection) . '</div>';
        } 
    }else{
        $contractID = mysqli_real_escape_string($connection, $_POST["contractID"]);
        $paymentMethodID = mysqli_real_escape_string($connection, $_POST["paymentMethodID"]);
        $paymentDate = mysqli_real_escape_string($connection, $_POST["paymentDate"]);
        $amountPaid = mysqli_real_escape_string($connection, $_POST["amountPaid"]);
        $amountToPay = mysqli_real_escape_string($connection, $_POST["amountToPay"]); 

        $query = "INSERT INTO payments (contractID, paymentMethodID, paymentDate, amountPaid, amountToPay) 
                VALUES ('$contractID', '$paymentMethodID', '$paymentDate', '$amountPaid', '$amountToPay')";
        $ret = mysqli_query($connection, $query);

        if ($ret) {
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['alert'] = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Contract Payment succesfully added.</span></div>';
        } else {
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error:' . mysqli_error($connection) . '</div>';
        } 
    }
?>