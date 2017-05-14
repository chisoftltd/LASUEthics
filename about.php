<?php
// Start a session
ob_start();
session_start();

// include the database script
require_once 'dbconnect.php';
/*
if (!isset($_SESSION['usr_id'])) {
    header("Location: index.php");
    echo "''<h1>.Timed Out!.</h1>";
}*/

?>
<!DOCTYPE html>
<html> <!-- Head area start-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>LASUEthics | About Us</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main-style.css">
</head>
<body> <!-- Body area start-->
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
            <a class="navbar-brand" href="about.php">LASUEthics | About Us</a>
        </div>
        <!-- check if same user is still same as the active session user and load appropriate menu options -->
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['usr_id'])) { ?>
                    <li><a href="signinindex.php">Home</a></li>
                    <li><a href="research.php">Researchs</a></li>
                    <li class="active"><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="officerprojecttable.php">Ethics Approval Officers (EAO)</a></li>
                    <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
                    <li><a href="logout.php">Log Out</a></li>
                <?php } else { ?>
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="about.php">About Us</a></li>
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
<!-- content div with belief note about research ethics web solution-->
<div class="container">
    <h3>Web Application Description - LASUEthics</h3>
    <p>
        This web application which I called LASUEthics is an online application that will manage LASU researcher’s
        experiment ethics. </p>
    <p>The interface should have a logo, navigation bar with elements like “Home”, “About Us”, “Research”,
        “Ethics Approval Officers (EAO)”, “Contact US” and “Login”. </p>
    <p>The interface should have a “News Section” about current government and university policy on research
        ethics. </p>
    <p>The landing page should contain a summary of, a least five, ongoing Ethics. Also present on the
        interface is are logos to Social media platforms like Facebook etc. </p>
    <p>The application will allow researchers, after authentication to seek approval for their propose experiment from
        EAO. EAOs should be able to approve, request additional information or reject an experiment proposal. </p>
    <p>To implement fairness and objectivity each experiment will be randomly assign to two different EAOs, by an
        Administrator.
    </p>
    <p>Furthermore, the application will allow researchers and staff to submit assessment of EAO and the EAOs in turn
        will also have same permission for the Administrators.
    </p>

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