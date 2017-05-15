<?php

// Start a session
ob_start();
session_start();

// include the database script
require_once 'dbconnect.php';

//if statement to process a POST data from a form when a submit buuton is clicked
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $human = intval($_POST['human']);
    $from = 'Demo Contact Form';
    $to = 'example@bootstrapbay.com';
    $subject = 'Message from Contact Demo ';

    $body = "From: $name\n E-Mail: $email\n Message:\n $message";

    // Check if name has been entered
    if (!$_POST['name']) {
        $errName = 'Please enter your name';
    }

    // Check if email has been entered and is valid
    if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errEmail = 'Please enter a valid email address';
    }

    //Check if message has been entered
    if (!$_POST['message']) {
        $errMessage = 'Please enter your message';
    }
    //Check if simple anti-bot test is correct
    if ($human !== 5) {
        $errHuman = 'Your anti-spam is incorrect';
    }

    // If there are no errors, send the email
    if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
        if (mail($to, $subject, $body, $from)) {
            $result = '<div class="alert alert-success">Thank You! I will be in touch</div>';
        } else {
            $result = '<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
        }
    }
}
?>
    <!DOCTYPE html>
    <html>
    <head><!-- Head area start-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>LASUEthics | Contact US</title>
        <link rel="stylesheet" href="css/main-style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.js"></script>
        <![endif]-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <!--<script src="http://maps.google.com/maps/api/js?sensor=false"></script>-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSMxRAhrNG_VHJdpz0h72CyugKoMmDMQU&callback=init_map"></script>
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
                <a class="navbar-brand" href="contact.php">LASUEthics | Contact US</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar1">
                <ul class="nav navbar-nav navbar-right">
                    <!-- check if same user is still same as the active session user and load appropriate menu options -->
                    <?php if (isset($_SESSION['usr_id'])) { ?>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="officerprojecttable.php">Ethics Approval Officers (EAO)</a></li>
                        <li><a href="registerresearcher.php">Register Researcher</a></li>
                        <li class="active"><a href="contact.php">Contact</a></li>
                        <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
                        <li><a href="logout.php">Log Out</a></li>
                    <?php } else { ?>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li class="active"><a href="contact.php">Contact</a></li>
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
    <div class="container"> <!--div with address and map information-->
        <form>
            <div class="row">
                <div id="map-outer" class="col-md-12">
                    <div id="address" class="col-md-4">
                        <h2>Our Location</h2>
                        <address>
                            <strong>LASUEthics | Research Ethics Solution</strong><br>
                            Lagos State University<br>
                            Lagos - Badagry Express Way<br>
                            PMB 0001 LASU Post Office<br>
                            Ojo<br>
                            Lagos<br>
                            Nigeria<br>
                            <br>
                            <abbr>P:</abbr> +234 8034939213
                        </address>
                        <br>
                        <address>
                            <strong>LASUEthics | Benjamin U. Chinwe</strong><br>
                            Jensen Education<br>
                            Stockholm - Sweden<br>
                            <br>
                            <abbr>P:</abbr> Nigeria +(00)234 908 043 3 684
                            <br>
                            <abbr>P:</abbr> Sweden +(00)46 752319508
                        </address>
                    </div>
                    <div id="map-container" class="col-md-8"></div>
                    <script> //function to get map location

                        function init_map() {
                            var var_location = new google.maps.LatLng(6.4691, 3.2003);

                            var var_mapoptions = {
                                center: var_location,
                                zoom: 14
                            };

                            var var_marker = new google.maps.Marker({
                                position: var_location,
                                map: var_map,
                                title: "Venice"
                            });

                            var var_map = new google.maps.Map(document.getElementById("map-container"),
                                var_mapoptions);

                            var_marker.setMap(var_map);

                        }

                        google.maps.event.addDomListener(window, 'load', init_map);

                    </script>
                </div>
            </div>
        </form>
    </div><!-- end of div container -->
    <form>
        <hr>
    </form>
    <div class="container"><!-- div for accepting messages-->
        <form class="form-horizontal" role="form" method="post" action="index.php">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name"
                           value="<?php echo htmlspecialchars($_POST['name']); ?>">
                    <?php echo "<p class='text-danger'>$errName</p>"; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com"
                           value="<?php echo htmlspecialchars($_POST['email']); ?>">
                    <?php echo "<p class='text-danger'>$errEmail</p>"; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="message" class="col-sm-2 control-label">Message</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="4"
                              name="message"><?php echo htmlspecialchars($_POST['message']); ?></textarea>
                    <?php echo "<p class='text-danger'>$errMessage</p>"; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
                    <?php echo "<p class='text-danger'>$errHuman</p>"; ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <?php echo $result; ?>
                </div>
            </div>
        </form>
    </div><!-- end of content div-->
    <!-- footer area-->
    <footer>
        <?php include 'include/footer.php'; ?>
    </footer>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
    </html>
<?php ob_end_flush(); ?>