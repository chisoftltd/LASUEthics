<?php
/**
 * Created by PhpStorm.
 * User: 1609963
 * Date: 21/04/2017
 * Time: 19:23
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
    $query = "SELECT * FROM research WHERE id =" . $id;
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
}


//check if form is submitted
if (isset($_POST['approve'])) {
    echo "I am here 0";
    $name = mysqli_real_escape_string($link, $_POST['$id']);
    $projecttopic = mysqli_real_escape_string($link, $_POST['$researchername']);
    $optradio = mysqli_real_escape_string($link, $_POST['optradio']);
    $approvaloname = mysqli_real_escape_string($link, $_POST['approvaloname']);
    $comment = mysqli_real_escape_string($link, $_POST['comment']);
    $todaydate = mysqli_real_escape_string($link, $_POST['todaydate']);
echo $todaydate;
    echo "I am here 1";
    if (mysqli_query($link, "INSERT INTO approvalofficers(name, projecttopic, status, approvalofficer, statuscomment, todaydate ) 
VALUES('" . $name . "','" . $projecttopic . "','" . $optradio . "','" . $approvaloname . "','" . $comment. "','" . $todaydate . "')")) {
        echo "I am here 2";
        $successmsg = "Your comment Successfuly Registered!";
        header("refresh:5; url=researchappovaltable.php");
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
    <div>
        <hr>
    </div>
    <h3>Research Number:</h3> <?php echo $row['id']; $id = $row['id']; ?>
    <div>
        <hr>
    </div>
    <h3>Researcher Name: </h3><?php echo $row['name']; $researchername = $row['name'];?>
    <div>
        <hr>
    </div>
    <h3>Project Supervisor: </h3><?php echo $row["supervisor"]; ?>
    <div>
        <hr>
    </div>
    <h3>Department: </h3><?php echo $row['department']; ?>
    <div>
        <hr>
    </div>
    <h3>Project Topic: </h3><?php echo $row['projecttopic']; ?>
    <div>
        <hr>
    </div>
    <h3>Project Description: </h3><?php echo $row['projectdescription']; ?>
    <div>
        <hr>
    </div>
    <h3>Start Date: </h3><?php echo $row['startdate']; ?>
    <div>
        <hr>
    </div>
    <h3>Deadline: </h3><?php echo $row['enddate']; ?>
    <div>
        <hr>
    </div>
    <h3>Data Handling details: </h3><?php echo $row['datadetails']; ?>
    <div>
        <hr>
    </div>
</div>
<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="approvalform" class="container">
    <div class="radio">
        <label><input type="radio" name="optradio">Approved</label>
    </div>
    <div class="radio">
        <label><input type="radio" name="optradio">Rejected</label>
    </div>
    <div class="form-group">
        <label for="name">Comment:</label>
                        <textarea name="comment" rows="20" cols="auto"
                                  placeholder="Provide a brief outline to support the option above."
                                  required class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="approvaloname">Approval Officer Name</label>
        <input type="text" name="approvaloname" placeholder="Enter Full Name" required
               value="<?php if ($error) echo $approvaloname; ?>" class="form-control"/>
        <label for="name">Todays Date</label>
        <input type="date" name="todaydate" placeholder="Today's Date" required class="form-control"/>
    </div>
    <div class="form-group">
        <input type="submit" name="approve" value="Submit" class="btn btn-primary"/>
    </div>
</form>
<footer>
    <?php include 'include/footer.php'; ?>
</footer>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
