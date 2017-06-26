<?php
    define("TITLE", "KH-Squared RIA | Contact");
    include('inc/header.php');
?>

<body class="contact-page">

<div class="page-header">

    <div class="container">

        <div class="row">

            <div class="col-sm-12">

                <div class="call-back">

                    <a href="index.php">
                        <span class="fa fa-chevron-circle-left"></span> <span class="text">Back</span>
                    </a>
                </div> <!-- /.call-back -->
            </div> <!-- /.col-sm-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</div> <!-- /.page-header -->

<div class="contact-form">

    <div class="container">

        <div class="row">

            <div class="col-sm-12">

                <div class="brand-group">

                    <img
                        src="img/logos/logo-khsquared-alt.png"
                        alt="KH-Squared Logo"
                        class="logo"
                    />
                    <div class="hb">KH&ndash;Squared</div>
                </div> <!-- /.brand-group -->
            </div> <!-- /.col-sm-12 -->
        </div> <!-- /.row -->
        
        <div class="row">
        
            <div class="col-sm-12">

                <h2>Contact Us</h2>

                <p>We assure to you that the registration of your firm will be conducted in a timely manner and up to the regulatory standards of the jurisdiction in which you operate. We understand that your time is valuable. Let us help you in this process so that you can focus your attention on other areas of your business.</p>
            </div> <!-- /.col-sm-12 -->
        </div> <!-- /.row -->

        <div class="row">

            <div class="col-sm-12">

                <?php

                    // Check for header injections
                    function has_header_injection($str) {
                        return preg_match( "/[\r\n]/", $str);
                    }
                    if (isset ($_POST["contact_submit"])) {

                        $name   = trim($_POST["name"]);
                        $email  = trim($_POST["email"]);
                        $phone  = $_POST["phone"];
                        $msg    = $_POST["message"];

                        // Check to see if $name or $email have header injections
                        if (has_header_injection($name) || has_header_injection($email) || has_header_injection($phone)) {
                            die(); // If true, kill the script
                        }

                        if ( !$name || !$email || !$msg ) {

                            echo '<div class="alert alert-danger" role="alert">Name, e&ndash;mail, and message fields are required. Thank you.<br><a href="contact.php">Go Back and Try Again</a></div>';
                            exit;
                        }

                        // Add the recipient email to a variable
                        $to = "info@kh2ria.com";

                        // Create a subject
                        $subject = "$name sent you a message via your contact form";

                        // Construct the actual message
                        $message = "Name: $name\r\n";
                        $message .= "Phone: $phone\r\n";
                        $message .= "Message:\r\n$msg";

                        $message = wordwrap($message, 72);

                        // Set the mail headers into a variable
                        $headers = "MIME-Version: 1.0\r\n";
                        $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
                        $headers .= "From: $name <$email>\r\n";
                        $headers .= "X-Priority: 1\r\n";
                        $headers .= "X-MSMail-Priority: High\r\n\r\n";

                        // Send the email
                        mail($to, $subject, $message, $headers);
                    
                ?>

                <div class="success">

                    <h2>Thank You!</h2>

                    <p>Someone will be with you shortly. If you don’t think you’ve received a response after a long period of time, be sure to check your spam in your  e-mail to make sure our response wasn’t filtered there.</p>

                    <a href="index.php" class="btn btn-kh">Back to Main Page</a>

                </div>

                <?php } else { ?>
                <form method="POST" action="" id="contact-form">
                    
                    <div class="form-group">

                        <label class="sr-only" for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>

                    <div class="form-group">

                        <label class="sr-only" for="email">E&dash;mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                    </div>

                    <div class="form-group">

                        <label class="sr-only" for="phone">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone (Optional)">
                    </div>

                    <div class="form-group"> 
                        <label class="sr-only" for="message">Message</label>
                        <textarea class="form-control" name="message" id="message" rows="3" placeholder="Message"></textarea>
                    </div>

                    <input type="submit" class="btn btn-kh" name="contact_submit" value="Send Message">

                    <a href="index.php" class="btn btn-kh-alt">Cancel</a>

                </form> <!-- form -->
                <?php } ?>

                
            </div> <!-- /.col-sm-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->

    <div class="modal fade" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Error!</h4>
                </div> <!-- /.modal-header -->

                <div class="modal-body">

                    <p>At least a first name, email address, and a message is required. Thank you.</p>
                </div> <!-- /.modal-body -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-kh" data-dismiss="modal">Okay</button>
                </div> <!-- /.modal-footer -->
            </div> <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div> <!-- /.modal fade -->
</div> <!-- /.contact-form -->

<?php include('inc/footer.php'); ?>