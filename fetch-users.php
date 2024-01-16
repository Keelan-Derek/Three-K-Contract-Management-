<?php
    //session_start();
    require_once ('dbconnect.php');
    $connection = dbconnect();

    if(isset($_SESSION['user'])){
        $userid = $_SESSION["user"];
    }

    $outputusers = '';
    if(isset($_POST["query"])){
        $search = mysqli_real_escape_string($connection, $_POST["query"]);
        $query = "SELECT * FROM `users` WHERE (`userID` LIKE '".$search."%') or (`firstName` LIKE '".$search."%') or (`lastName` LIKE '".$search."%') or (`userRole` LIKE '%".$search."%') or (`email` LIKE '".$search."%') or (`phoneNumber` LIKE '".$search."%') or (`dateLastUpdated` LIKE '".$search."%')";
    }else{
      if(isset($_POST["request"])){
        $request = $_POST["request"];
        $query = "SELECT * FROM users ORDER BY $request";
      }else{
        $query = "SELECT * FROM users";
      }
    }
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) > 0){
     $outputusers .= ' <div class="table-responsive">
       <table class="table table-bordered table-light rounded" id="users_table">
        <thead class="thead-dark">
        <tr>
        <th>User ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>User Access Role</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Date Last Updated</th>
        <th colspan="2" class="d-print-none">Commands</th>
        </tr>
        </thead>';
     while($row = mysqli_fetch_array($result))
     {
      $outputusers .= '
       <tr id="row'. $row["userID"].'">
            <td>' .$row["userID"].'</td>
            <td>' .$row["firstName"]. '</td>
            <td>' .$row["lastName"]. '</td>
            <td>' .$row["userRole"]. '</td>
            <td><a href="mailto:'.$row["email"].'">' .$row["email"]. '</a></td>
            <td>' .$row["phoneNumber"]. '</td>
            <td>' .$row["dateLastUpdated"]. '</td>
            <td class="d-print-none"> <form method="POST" action="edit.php?id=' .$row['userID']. '"><input type="submit" class="btn btn-outline-success" id="' .$row["userID"]. '" value="Edit" name="edituser"></form></td>
            <td class="d-print-none"> <form method="POST" action="delete.php?id=' .$row['userID']. '"><input type="submit" class="btn btn-outline-danger" id="' .$row["userID"]. '" value="Delete" name="deleteuser"></form></td>
       </tr>';
     }
    
     echo $outputusers;
    }else
    {
     echo '<div class="alert alert-warning text-center h5" role="alert">Data Not Found </div>';
    }



?>