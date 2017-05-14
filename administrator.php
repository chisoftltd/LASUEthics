<?php
/**
 * Created by PhpStorm.
 * User: Chisoft
 * Date: 2017-04-22
 * Time: 22:55
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

?>

<!DOCTYPE html>
<html> <!-- Head area start-->
<head>
    <title>LASUEthics | Administrator</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main-style.css">
</head>

<body><!-- Body area start-->
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
            <a class="navbar-brand" href="administrator.php">LASUEthics | Administrator</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                <!-- check if same user is still same as the active session user and load appropriate menu options -->
                <?php if (isset($_SESSION['usr_id'])) { ?>
                    <li><a href="signinindex.php">Home</a></li>
                    <li><a href="research.php">Researchs</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="officerprojecttable.php">Ethics Approval Officers (EAO)</a></li>
                    <li class="active"><a href="administrator.php">Administrator</a></li>
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
<!-- content div with administrator platform to display all the tables in the database-->
<div class="container">
    <fieldset> <!-- fieldset display Research Table -->
        <legend style="text-align: center">Research Table</legend>
        <?php
        $sql = "SHOW TABLES FROM localdb LIKE 'research'";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "DB Error, could not list tables\n";
            echo 'MySQL Error: ' . mysqli_error();
            exit;
        }
        while ($row = mysqli_fetch_row($result)) {
            $result2 = mysqli_query($link, "SELECT * FROM research") or die('cannot show columns from research');
            $count = mysqli_num_rows($result2);
            if (mysqli_num_rows($result2)) {
                echo '<table cellpadding="0" cellspacing="0" class="table table-striped">';
                echo '<tr><th>Project ID</th><th>Researcher Name</th><th>Supervisor</th><th>Project Topic</th><th>Start Date</th><th>End Date</th></tr>';
                while ($row2 = mysqli_fetch_array($result2)) {
                    echo '<tr>';
                    echo "<td>" . $row2[id] . "</td>";
                    echo "<td><a href='updatepage.php?p={$row2['id']}'>" . $row2[name] . "</td>";
                    echo "<td>" . $row2[supervisor] . "</td>";
                    echo "<td><a href='updatepage.php?p={$row2['id']}'>" . $row2[projecttopic] . "</a></td>";
                    echo "<td>" . $row2[startdate] . "</td>";
                    echo "<td>" . $row2[enddate] . "</td>";
                    echo "</tr>";
                }
                echo '</table><br />';
            }

        }

        ?>
    </fieldset><!--end of fieldset-->
    <div>
        <hr>
    </div>
    <fieldset> <!-- fieldset display Researcher Table -->
        <legend style="text-align: center">Researcher Table</legend>
        <?php
        $sql = "SHOW TABLES FROM localdb LIKE 'researchers'";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "DB Error, could not list tables\n";
            echo 'MySQL Error: ' . mysqli_error();
            exit;
        }
        while ($row = mysqli_fetch_row($result)) {
            $result2 = mysqli_query($link, "SELECT * FROM researchers") or die('cannot show columns from research');
            $count = mysqli_num_rows($result2);
            if (mysqli_num_rows($result2)) {
                echo '<table cellpadding="0" cellspacing="0" class="table table-striped">';
                echo '<tr><th>Student ID</th><th>Researcher Name</th><th>Email</th><th>Regstration Date</th></tr>';
                while ($row2 = mysqli_fetch_array($result2)) {
                    echo '<tr>';
                    echo "<td>" . $row2[id] . "</td>";
                    echo "<td><a href='updatepage.php?p={$row2['id']}'>" . $row2[name] . "</td>";
                    echo "<td>" . $row2[email] . "</td>";
                    echo "<td><a href='updatepage.php?p={$row2['id']}'>" . $row2[date] . "</a></td>";
                    echo "</tr>";
                }
                echo '</table><br />';
            }

        }

        ?>
    </fieldset><!--End of fieldset-->
    <div>
        <hr>
    </div>
    <fieldset><!-- fieldset display Approval Officers Table -->
        <legend style="text-align: center">Approval Officers Table</legend>
        <?php
        $sql = "SHOW TABLES FROM localdb LIKE 'approvalofficers'";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "DB Error, could not list tables\n";
            echo 'MySQL Error: ' . mysqli_error();
            exit;
        }
        while ($row = mysqli_fetch_row($result)) {
            $result2 = mysqli_query($link, "SELECT * FROM approvalofficers") or die('cannot show columns from research');
            $count = mysqli_num_rows($result2);
            if (mysqli_num_rows($result2)) {
                echo '<table cellpadding="0" cellspacing="0" class="table table-striped">';
                echo '<tr><th>Student ID</th><th>Researcher Name</th><th>Project Topic</th><th>Research Status</th><th>Approval Officer</th><th>Comments</th><th>Approval Date</th></tr>';
                while ($row2 = mysqli_fetch_array($result2)) {
                    echo '<tr>';
                    echo "<td>" . $row2[id] . "</td>";
                    echo "<td>" . $row2[name] . "</td>";
                    echo "<td><a href='updatepage.php?p={$row2['id']}'>" . $row2[projecttopic] . "</td>";
                    echo "<td>" . $row2[status] . "</a></td>";
                    echo "<td>" . $row2[approvalofficer] . "</td>";
                    echo "<td>" . $row2[statuscomment] . "</td>";
                    echo "<td>" . $row2[todaydate] . "</td>";
                    echo "</tr>";
                }
                echo '</table><br />';
            }
        }
        ?>
    </fieldset><!-- End of Fieldset-->
    <div>
        <hr>
    </div>
    <fieldset><!-- fieldset display Log Table -->
        <legend style="text-align: center">Log Table</legend>
        <?php
        $sql = "SHOW TABLES FROM localdb LIKE 'logtable'";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "DB Error, could not list tables\n";
            echo 'MySQL Error: ' . mysqli_error();
            exit;
        }
        while ($row = mysqli_fetch_row($result)) {
            $result2 = mysqli_query($link, "SELECT * FROM logtable") or die('cannot show columns from research');
            $count = mysqli_num_rows($result2);
            if (mysqli_num_rows($result2)) {
                echo '<table cellpadding="0" cellspacing="0" class="table table-striped">';
                echo '<tr><th>Student ID</th><th>Researcher Name</th><th>Login Date</th><th>Logout Date</th></tr>';
                while ($row2 = mysqli_fetch_array($result2)) {
                    echo '<tr>';
                    echo "<td>" . $row2[id] . "</td>";
                    echo "<td><a href='updatepage.php?p={$row2['id']}'>" . $row2[username] . "</td>";
                    echo "<td>" . $row2[logindate] . "</td>";
                    echo "<td>" . $row2[logoutdate] . "</a></td>";
                    echo "</tr>";
                }
                echo '</table><br />';
            }
        }
        ?>
    </fieldset><!--End of log table-->
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

