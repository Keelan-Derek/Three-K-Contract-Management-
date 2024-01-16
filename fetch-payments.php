<?php
    session_start();
    require_once ('dbconnect.php');
    $connection = dbconnect();

    if(isset($_SESSION['user'])){
        $userid = $_SESSION["user"];
    }

    /*
    $qry = "SELECT * FROM payment_method";
    $ret = mysqli_query($connection, $qry);

    while($row = mysqli_fetch_array($ret)){
        $paymentMethod  = " - ". $row["methodName"] ;
    }
    */ 

    $outputpayments = '';
    if(isset($_POST["query"])){
        $search = mysqli_real_escape_string($connection, $_POST["query"]);
        $query = "SELECT * FROM `payments` WHERE (`paymentID` LIKE '".$search."%') or (`contractID` LIKE '".$search."%') or (`paymentMethodID` LIKE '".$search."%') or (`paymentDate` LIKE '%".$search."%') or (`amountPaid` LIKE '".$search."%') or (`amountToPay` LIKE '".$search."%')";
    }else{
      if(isset($_POST["request"])){
        $request = $_POST["request"];
        $query = "SELECT * FROM payments ORDER BY $request";
      }else{
        $query = "SELECT * FROM payments";
      }
    }
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) > 0){
     $outputpayments .= ' <div class="table-responsive">
       <table class="table table-bordered table-light rounded" id="payments_table">
        <thead class="thead-dark">
        <tr>
        <th>Payment ID</th>
        <th>Contract ID</th>
        <th>Payment Method ID</th>
        <th>Payment Date</th>
        <th>Amount Paid</th>
        <th>Amount To Pay</th>
        <th colspan="2" class="d-print-none">Commands</th>
        </tr>
        </thead>';
     while($row = mysqli_fetch_array($result))
     {
    $methodID = $row["paymentMethodID"];
    $query2 = "SELECT * FROM payment_method, payments WHERE payment_method.paymentMethodID = $methodID AND payment_method.paymentMethodID = payments.paymentMethodID";
    $ret2 = mysqli_query($connection, $query2);
    $row2 = mysqli_fetch_array($ret2);

      $outputpayments .= '
       <tr id="row'. $row["paymentID"].'">
            <td>' .$row["paymentID"].'</td>
            <td><a href="viewcontract.php?id='.$row['contractID'].'"> ' .$row["contractID"]. '</a></td>
            <td>' .$row["paymentMethodID"]. ' - ' .$row2["methodName"]. '</td>
            <td>' .$row["paymentDate"]. '</a></td>
            <td>' .$row["amountPaid"]. '</td>
            <td>' .$row["amountToPay"]. '</td>
            <td class="d-print-none"> <form method="POST" action="edit.php?id=' .$row['paymentID']. '"><input type="submit" class="btn btn-outline-success" id="' .$row["paymentID"]. '" value="Edit" name="editpayment"></form></td>
            <td class="d-print-none"> <form method="POST" action="delete.php?id=' .$row['paymentID']. '"><input type="submit" class="btn btn-outline-danger" id="' .$row["paymentID"]. '" value="Delete" name="deletepayment"></form></td>
       </tr>';
     }
    
     echo $outputpayments;
    }else
    {
     echo '<div class="alert alert-warning text-center h5" role="alert">Data Not Found </div>';
    }



?>

