<?php
    session_start();
    require_once ('dbconnect.php');
    $connection = dbconnect();
    $userid = $_SESSION["user"];

    $_SESSION['message']= "";

    $modalForm = "";

    if(isset($_POST["modalForm"])){
        $modalForm = $_POST["modalForm"];
    }

    if($modalForm == "deleteContract"){

        $contractID = mysqli_real_escape_string($connection, $_POST["contractID"]);

        $query = "DELETE FROM contracts WHERE contractID='".$contractID."'  ";
        $ret = mysqli_query($connection, $query);

        if($ret){
            header("location:index1.php?page=contracts");
            $_SESSION['message'] = '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Contract succesfully deleted.</span></div>';
        }else{
            header("location:index1.php?page=contracts");
            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error: ' . mysqli_error($connection) . '</div>';
        }
    }else if($modalForm == "deletePayment"){

        $paymentID = mysqli_real_escape_string($connection, $_POST["paymentID"]);

        $query = "DELETE FROM payments WHERE paymentID='".$paymentID."'  ";
        $ret = mysqli_query($connection, $query);

        if($ret){
            header("location:index1.php?page=payments");
            $_SESSION['message'] = '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Payment succesfully deleted.</span></div>';
        }else{
            header("location:index1.php?page=payments");
            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error: ' . mysqli_error($connection) . '</div>';
        }
    }else if($modalForm == "deleteService"){

        $serviceID = mysqli_real_escape_string($connection, $_POST["serviceID"]);

        $query = "DELETE FROM service_offerings WHERE serviceID='".$serviceID."'  ";
        $ret = mysqli_query($connection, $query);

        if($ret){
            header("location:index1.php?page=service_offerings");
            $_SESSION['message'] = '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Service Offering succesfully deleted.</span></div>';
        }else{
            header("location:index1.php?page=service_offerings");
            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error: ' . mysqli_error($connection) . '</div>';
        }
    }else if($modalForm =="deleteUser"){

        $userID = mysqli_real_escape_string($connection, $_POST["userID"]);

        $query = "DELETE FROM users WHERE userID='".$userID."'  ";
        $ret = mysqli_query($connection, $query);

        if($ret){
            header("location:index1.php?page=users");
            $_SESSION['message'] = '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">System User succesfully deleted.</span></div>';
        }else{
            header("location:index1.php?page=users");
            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error: ' . mysqli_error($connection) . '</div>';
        }
    }else if($modalForm == "deleteContract2"){

        $custContractID = mysqli_real_escape_string($connection, $_POST["contractID"]);

        $qry = "SELECT * FROM customers, contracts WHERE contractID=$custContractID AND contracts.customerID = customers.customerID";
        $rest = mysqli_query($connection, $qry);
        if(!$rest){
            echo "Error" . mysqli_error($connection);
        }else{
            $row = mysqli_fetch_array($rest);
        }

        $custID = $row['customerID'];

        $query = "DELETE FROM contracts WHERE contractID='".$custContractID."' ";
        $ret = mysqli_query($connection, $query);

        if($ret){
            header("location:viewcustomer.php?id=$custID");
            $_SESSION['message'] = '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Customer Contract succesfully deleted.</span></div>';
        }else{
            header("location:viewcustomer.php?id=$custID");
            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error: ' . mysqli_error($connection) . '</div>';
        }
    }else if($modalForm == "deleteActivity"){
        $contractID = mysqli_real_escape_string($connection, $_POST["contractID"]);
        $activityID = mysqli_real_escape_string($connection, $_POST["activityID"]);

        $qry = "SELECT * FROM contracts WHERE contractID=$contractID";
        $rest = mysqli_query($connection, $qry);
        if(!$rest){
            echo "Error" . mysqli_error($connection);
        }else{
            $row = mysqli_fetch_array($rest);
        }

        $contractID = $row['contractID'];

        $query = "DELETE FROM contract_activities WHERE contractID=$contractID AND activityID=$activityID";
        $ret = mysqli_query($connection, $query);

        if($ret){
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['message'] = '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Contract Activity succesfully deleted.</span></div>';
        }else{
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error: ' . mysqli_error($connection) . '</div>';
        }
    }else if($modalForm == "deleteUpload"){
        $uploadID =  mysqli_real_escape_string($connection, $_POST["uploadID"]);
        $contractID = mysqli_real_escape_string($connection, $_POST["contractID"]);

        $query = "DELETE FROM uploads WHERE uploadID=$uploadID";
        $ret = mysqli_query($connection, $query);

        if($ret){
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['message'] = '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Contract Document succesfully deleted.</span></div>';
        }else{
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error: ' . mysqli_error($connection) . '</div>';
        }
    }else if($modalForm == "deletePayment2"){
        $paymentID = mysqli_real_escape_string($connection, $_POST["paymentID"]);
        $contractID = mysqli_real_escape_string($connection, $_POST["contractID"]);

        $query = "DELETE FROM payments WHERE paymentID=$paymentID";
        $ret = mysqli_query($connection, $query);

        if($ret){
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['message'] = '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Contract Payment succesfully deleted.</span></div>';
        }else{
            header("location:viewcontract.php?id=$contractID");
            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error: ' . mysqli_error($connection) . '</div>';
        }
    } else if($modalForm == "deleteContract3"){
        $contractID = mysqli_real_escape_string($connection, $_POST["contractID"]);

        $query = "DELETE FROM contracts WHERE contractID='".$contractID."'  ";
        $ret = mysqli_query($connection, $query);

        if($ret){
            header("location:index1.php?page=contracts");
            $_SESSION['message'] = '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Contract succesfully deleted.</span></div>';
        }else{
            header("location:index1.php?page=contracts");
            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error: ' . mysqli_error($connection) . '</div>';
        }
    } 
?>