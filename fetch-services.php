<?php
    //session_start();
    require_once ('dbconnect.php');
    $connection = dbconnect();

    if(isset($_SESSION['user'])){
        $userid = $_SESSION["user"];
    }

    $outputservices = '';
    if(isset($_POST["query"])){
        $search = mysqli_real_escape_string($connection, $_POST["query"]);
        $query = "SELECT * FROM `service_offerings` WHERE (`serviceID` LIKE '".$search."%') or (`serviceName` LIKE '".$search."%') or (`serviceDesc` LIKE '".$search."%') or (`dateLastUpdated` LIKE '%".$search."%')";
    }else{
      if(isset($_POST["request"])){
        $request = $_POST["request"];
        $query = "SELECT * FROM service_offerings ORDER BY $request";
      }else{
        $query = "SELECT * FROM service_offerings";
      }
    }
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) > 0){
     $outputservices .= ' <div class="table-responsive">
       <table class="table table-bordered table-light rounded" id="services_table">
        <thead class="thead-dark">
        <tr>
        <th>Service ID</th>
        <th>Serice Name</th>
        <th>Service Description</th>
        <th>Date Last Updated</th>
        <th colspan="2" class="d-print-none">Commands</th>
        </tr>
        </thead>';
     while($row = mysqli_fetch_array($result))
     {
      $outputservices .= '
       <tr id="row'. $row["serviceID"].'">
            <td>' .$row["serviceID"].'</td>
            <td>' .$row["serviceName"]. '</td>
            <td>' .$row["serviceDesc"]. '</td>
            <td>' .$row["dateLastUpdated"]. '</td>
            <td class="d-print-none"> <form method="POST" action="edit.php?id=' .$row['serviceID']. '"><input type="submit" class="btn btn-outline-success" id="' .$row["serviceID"]. '" value="Edit" name="editservice"></form></td>
            <td class="d-print-none"> <form method="POST" action="delete.php?id=' .$row['serviceID']. '"><input type="submit" class="btn btn-outline-danger" id="' .$row["serviceID"]. '" value="Delete" name="deleteservice"></form></td>
       </tr>';
     }
    
     echo $outputservices;
    }else
    {
     echo '<div class="alert alert-warning text-center h5" role="alert">Data Not Found </div>';
    }



?>