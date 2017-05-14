<?php
/**
 * Created by PhpStorm.
 * User: 1609963
 * Date: 21/04/2017
 * Time: 18:45
 */

session_start();

if (!isset($_SESSION['usr_id'])) {
    header("Location: index.php");
    echo "''<h1>.Timed Out!.</h1>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LASUEthics | research Database</title>
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
            <a class="navbar-brand" href="researchtable.php">LASUEthics | Research Database</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['usr_id'])) { ?>
                    <li class="active"><a href="signinindex.php">Home</a></li>
                    <li><a href="research.php">Research</a></li>
                    <li><a href="officerprojecttable.php">Ethics Approval Officers (EAO)</a></li>
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

    <?php
    include_once "dbconnect.php";

        echo '<h3>', RESEARCH, '</h3>';
        $result2 = mysqli_query($link, "SELECT id, name, supervisor, projecttopic, startdate, enddate FROM research") or die('cannot show columns from research' );
        $count = mysqli_num_rows($result2);
        if (mysqli_num_rows($result2)) {
            echo '<table cellpadding="0" cellspacing="0" class="table table-striped">';
            echo '<tr><th>Project ID</th><th>Researcher Name</th><th>Supervisor</th><th>Project Topic</th><th>Start Date<th>End Date</th></tr>';
            while ($row2 = mysqli_fetch_array($result2)) {
                echo '<tr>';
                echo "<td>" . $row2[id] . "</td>";
                echo "<td>" . $row2[name] . "</td>";
                echo "<td>" . $row2[supervisor] . "</td>";
                echo "<td><a href='projdetails.php?p={$row2['id']}'> " . $row2[projecttopic] . "</a></td>";
                echo "<td>" . $row2[startdate] . "</td>";
                echo "<td>" . $row2[enddate] . "</td>";
                echo "</tr>";
            }
            echo '</table><br />';
    }
    ?>
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
