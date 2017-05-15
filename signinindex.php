<?php
/**
 * Created by PhpStorm.
 * User: 1609963
 * Date: 21/04/2017
 * Time: 17:46
 */

session_start();
include_once 'dbconnect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home | LASUEthics System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
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
            <a class="navbar-brand" href="signinindex.php">Home | LASUEthics System</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['usr_id'])) { ?>
                    <li class="active"><a href="signinindex.php">Home</a></li>
                    <li> <a href="research.php">Research</a></li>
                    <li> <a href="officerprojecttable.php">Ethics Approval Officers (EAO)</a></li>
                    <li><a href="administrator.php">Administrator</a></li>
                    <li><a href="api/images/ethicsjson.php">EthicsJSON</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
                    <li><a href="logout.php">Log Out</a></li>
                <?php } else { ?>
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="api/images/ethicsjson.php">EthicsJSON</a></li>
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
<div class="pageContent">
    <article class="article">
        <h2>Research Ethics and Integrity System</h2>
        <p>A Full Research Ethics and Integrity Assessment is required before, during and maybe after a research
            project. Most research institution and centers are
            commitment to promote and facilitate the conduct of research ethics and integrity.</p>
        <h3>Purpose of Ethical Standards</h3>
        <p>In line with acceptable police and framework, LASU attaches great importance to addressing the ethical
            implications of all research activities
            carried out by its members, be they undergraduates, postgraduates or academic members of staff.
            Attention to the ethical and legal implications of research for researchers, research subjects, sponsors and
            collaborators is an intrinsic
            part of good research <a
                href="http://www.ed.ac.uk/geosciences/intranet/working-in-school/other-important-information/ethicsinresearch">practice.</a>
        </p>
        <p>You need to assess whether your project needs an ethical submission. This can be done by completing the RESSA
            form and based on the outcome decide whether an application is needed.</p>
        <p><a class="more"
              href="http://www.lasu.edu.ng/images/bulletins/student_personal_ethics_statement_form.pdf">Researcher
                and Supervisor Appraisal (RESSA) Form</a></p>
        <h3>Assessment of Research Ethics is very important expecially when the following groups are involved:</h3>
        <ul>
            <li>vulnerable human subjects (e.g. children, people with cognitive disabilities and so on)
            </li>
            <li>invasive procedures or addressing sensitive issues (e.g. video-taping without informed consent,
                questions about sexuality or about criminal<br> behaviour)
            </li>
            <li>biophysical research which requires extraordinary permission from landowners, involves significant
                disturbance to vulnerable species or habitats,<br> sampling rare/endangered or harmful taxa/species,
                and/or transporting samples/specimens between countries or significant ‘boundaries’.
            </li>
        </ul>

    </article>
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