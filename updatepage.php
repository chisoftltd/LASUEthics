<?php
/**
 * Created by PhpStorm.
 * User: Chisoft
 * Date: 2017-04-26
 * Time: 02:35
 */

ob_start();
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['usr_id'])) {
    header("Location: index.php");
    echo "''<h1>.Timed Out!.</h1>";
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['p'];
    $query1 = "SELECT * FROM research WHERE id =" . $id;
    $result = mysqli_query($link, $query1);
    $row = mysqli_fetch_array($result);
}


//check if form is submitted
if (isset($_POST['update'])) {
    $number = mysqli_real_escape_string($link, $_POST['number']);
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $supervisor = mysqli_real_escape_string($link, $_POST['supervisor']);
    $department = mysqli_real_escape_string($link, $_POST['department']);
    $projecttopic = mysqli_real_escape_string($link, $_POST['projecttopic']);
    $projectdescription = mysqli_real_escape_string($link, $_POST['projectdescription']);
    $startdate = mysqli_real_escape_string($link, $_POST['startdate']);
    $enddate = mysqli_real_escape_string($link, $_POST['enddate']);
    $datadetails = mysqli_real_escape_string($link, $_POST['datadetails']);

    $query2 = "UPDATE research SET name = '$name', supervisor = '$supervisor', department='$department', 
    projecttopic ='$projecttopic', projectdescription ='$projectdescription', startdate ='$startdate', 
    enddate ='$enddate', datadetails = '$datadetails'  WHERE id =" . $number;


    if (mysqli_query($link, $query2)) {
        $successmsg = "Your comment Successfuly updated!";
        header("refresh:5; url=officerprojecttable.php");
    } else {

        $errormsg = "Error in registering...Please try again later!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LASUEthics | Ethics Approval Officers (EAO)</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main-style.css">
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Research Ethics Database</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['usr_id'])) { ?>
                    <li><a href="signinindex.php">Home</a></li>
                    <li><a href="research.php">Research</a></li>
                    <li class="active"><a href="officerprojecttable.php">Ethics Approval Officers (EAO)</a></li>
                    <li><a href="administrator.php">Administrator</a></li>
                    <li><a href="about.php">About Us</a></li>
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
<header>
    <?php if (isset($_SESSION['usr_id'])) { ?>
        <?php include 'include/signinheader.php'; ?>

    <?php } else { ?>
        <?php include 'include/header.php'; ?><?php } ?>
</header>
<form>
    <hr>
</form>
<div class="container">
    <div class="col-md-8 col-md-offset-2 well">
        <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="approvalform">
            <fieldset>
                <legend>Ethics Update Form</legend>
                <div>
                    <hr>
                </div>
                <div class="input-group">
                    <label for="number">Research Number:</label>
                    <span></span>
                    <input type="number" name="number" value="<?php echo $row['id']; ?>"/>
                </div>
                <div>
                    <hr>
                </div>
                <div class="input-group">
                    <label for="name">Researcher Name: </label>
                    <input type="text" name="name" value="<?php echo $row['name']; ?>"/>
                </div>
                <hr>
                <div>
                    <label for="supervisor">Project Supervisor: </label>
                    <input type="text" name="supervisor" value="<?php echo $row["supervisor"]; ?>"
                    />
                </div>
                <div>
                    <hr>
                </div>
                <div>
                    <label for="department">Department: </label>
                    <input type="text" name="department" value="<?php echo $row['department']; ?>"
                    />
                </div>
                <div>
                    <hr>
                </div>
                <div>
                    <label for="projecttopic">Project Topic: </label>
                    <input type="text" name="projecttopic" value="<?php echo $row['projecttopic']; ?>"
                    />
                </div>
                <div>
                    <hr>
                </div>
                <div>
                    <label for="projectdescription">Project Description: </label>
                    <textarea type="text" rows="15" cols="auto" name="projectdescription"
                              style="text-align:left">
                                      <?php echo $row['projectdescription']; ?></textarea>
                </div>
                <div>
                    <hr>
                </div>
                <div>
                    <label for="startdate">Start Date: </label>
                    <input type="date" name="startdate" value="<?php echo $row['startdate']; ?>"/>
                </div>
                <div>
                    <hr>
                </div>
                <div>
                    <label for="enddate">Deadline:</label>
                    <input type="date" name="enddate" value="<?php echo $row['enddate']; ?>"/>
                </div>
                <div>
                    <hr>
                </div>
                <div>
                    <label for="datadetails">Data Handling details:</label>
                    <textarea type="text" rows="10" cols="auto" name="datadetails" style="text-align: left">
                                      <?php echo $row['datadetails']; ?></textarea>
                </div>
                <div>
                    <hr>
                </div>
                <div class="form-group">
                    <input type="submit" name="update" value="Update" class="btn btn-primary"/>
                </div>
            </fieldset>
        </form>
        <span class="text-success"><?php if (isset($successmsg)) {
                echo $successmsg;
            } ?></span>
        <span class="text-danger"><?php if (isset($errormsg)) {
                echo $errormsg;
            } ?></span>
    </div>
</div>
<footer>
    <?php include 'include/footer.php'; ?>
</footer>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
