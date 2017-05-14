<?php
/**
 * Created by PhpStorm.
 * User: 1609963
 * Date: 21/04/2017
 * Time: 22:20
 */

// Start a session
ob_start();
session_start();

// include the database script
require_once 'dbconnect.php';

// Return to home page if user not same
if (!isset($_SESSION['usr_id'])) {
    header("Location: index.php");
    echo "''<h1>.Wrong User!.</h1>";
}

// Process a GET from officerprojecttable.php and user the id to find the approval officer from the database
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['p'];
    $query = "SELECT approvalofficer FROM approvalofficers WHERE id =" . $id;
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
}
?>

<!DOCTYPE html>
<html>
<head><!-- Head area start-->
    <title>LASUEthics | Approval Officer</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main-style.css">
</head>
<body>
<!-- Body area start-->
<!-- add top navigational bar using bootstrap-->
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="approvalofficerdetails.php">LASUEthics | Approval Officer</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                <!-- check if same user is still same as the active session user and load appropriate menu options -->
                <?php if (isset($_SESSION['usr_id'])) { ?>
                    <li><a href="signinindex.php">Home</a></li>
                    <li><a href="research.php">Research</a></li>
                    <li class="active"><a href="officerprojecttable.php">Ethics Approval Officers (EAO)</a></li>
                    <li><a href="administrator.php">Administrator</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
                    <li><a href="logout.php">Log Out</a></li>
                <?php } else { ?>
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="registerresearcher.php">Register Researcher</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<!-- add header with navigational bar which interface depends on if there is an active user or not-->
<header>
    <?php if (isset($_SESSION['usr_id'])) { ?>
        <?php include 'include/signinheader.php'; ?>

    <?php } else { ?>
        <?php include 'include/header.php'; ?><?php } ?>
</header>
<form>
    <hr>
</form>
<div class="container"><!-- display the details of a selected research ethics approval offier-->
    <div>
        <hr>
    </div>
    <h3>Research Number:</h3> <?php echo $row['id']; ?>
    <div>
        <hr>
    </div>
    <h3>Researcher Name: </h3><?php echo $row['name']; ?>
    <div>
        <hr>
    </div>
    <h3>Project Topic: </h3><?php echo $row['projecttopic']; ?>
    <div>
        <hr>
    </div>
    <h3>Approval Officer: </h3><?php echo $row['approvalofficer']; ?>
    <div>
        <hr>
    </div>
    <h3>Status: </h3><?php echo $row['status']; ?>
    <div>
        <hr>
    </div>
    <h3>Comment: </h3><?php echo $row['statuscomment']; ?>
    <div>
        <hr>
    </div>
    <h3>Date: </h3><?php echo $row['todaydate']; ?>
    <div>
        <hr>
    </div>
</div><!-- end of content div-->
<!-- footer area-->
<footer>
    <?php include 'include/footer.php'; ?>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script><!-- jQuery library -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Latest compiled JavaScript -->
</body>
</html>
