<?php
require_once ('dbconnect.php');
session_start();

@$page = $_GET["page"];

include_once ('header.php');

switch (@$page){
    case "home":
        include ("home.php");
        break;
    case "customers":
        include ("customers.php");
        break;
    case "contracts":
        include ("contracts.php");
        break;
    case "payments":
        include ("payments.php");
        break;
    case "service_offerings":
        include ("service-offerings.php");
        break;
    case "users":
        include ("users.php");
        break;
    case "myaccount":
        include ("myaccount.php");
        break;
}

include_once ('footer.php');
?>