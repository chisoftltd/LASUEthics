<?php
/**
 * Created by PhpStorm.
 * User: Chisoft
 * Date: 2017-05-02
 * Time: 15:02
 */
?>

<!DOCTYPE html>
<html>
<head>
    <title>LASUEthics | JSON</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main-style.css">
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
            <a class="navbar-brand" href="../researchers.php">LASUEthics | JSON</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['usr_id'])) { ?>
                    <li class="active"><a href="../../signinindex.php">Home</a></li>
                    <li><a href="../../research.php">Research</a></li>
                    <li><a href="../../officerprojecttable.php">Ethics Approval Officers (EAO)</a></li>
                    <li><a href="../../administrator.php">Administrator</a></li>
                    <li><a href="../researchers.php">EthicsJSON</a></li>
                    <li><a href="../../about.php">About Us</a></li>
                    <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
                    <li><a href="../../logout.php">Log Out</a></li>
                <?php } else { ?>
                    <li class="active"><a href="../../index.php">Home</a></li>
                    <li><a href="../../about.php">About Us</a></li>
                    <li><a href="../researchers.php">EthicsJSON</a></li>
                    <li><a href="../../contact.php">Contact</a></li>
                    <li><a href="../../login.php">Login</a></li>
                    <li><a href="../../registerresearcher.php">Register Researcher</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<header>
    <?php if (isset($_SESSION['usr_id'])) { ?>
        <?php include '../include/signinheader.php'; ?>

    <?php } else { ?>
        <?php include '../include/header.php'; ?><?php } ?>
</header>
<form>
    <hr>
</form>
<div class="pageContent">
    <?php
    // Start a session
    ob_start();
    session_start();
    // include the database script
    require_once '../dbconnect.php';
    // Return to home page if user not same
    echo '<h3 style="text-align: center">', WEB_API_of_Table_researchers, '</h3>';

    $query = mysqli_query($link, 'select * from researchers');
    $rows = array();
    if (mysqli_num_rows($query)) {
        while ($row = mysqli_fetch_row($query)) {
            $rows[] = $row;
        }
        echo json_encode($rows);
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
