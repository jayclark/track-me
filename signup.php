<?php
include("connect.php");

if(isset($_SESSION))
{
    session_destroy();   // destroy session data in storage
    session_unset();     // unset $_SESSION variable for the runtime
}
session_start();
$_SESSION['EMAIL'] = false;

?>
<!DOCTYPE xhtml PUBLIC "-//W3C//DTD XHTML 4.01//EN">
<html>
<head>
    <title>Sign Up!</title>

<?php
    include("html5head.php");
?>
</head>
<body>


<?php
include("menu.php");

$msg = "";

// Function to validate against any email injection attempts
function IsInjected($str)
{
    # A few quick tests to validate the email address.
    # Empty?
    if(strlen($str) < 1) { return true; }

    # Valid?
    if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',$str))
    { return true; }

    # Now test for sql injection.
    $injections = array('(\n+)',
        '(\r+)',
        '(\t+)',
        '(%0A+)',
        '(%0D+)',
        '(%08+)',
        '(%09+)'
    );
    $inject = join('|', $injections);
    $inject = "/$inject/i";

    if(preg_match($inject,$str)) { return true; }
    else { return false; }
}

$email = null;

if(isset($_REQUEST["email"])) { $email = mysql_real_escape_string($_REQUEST["email"]); }

if(isset($email) AND IsInjected($email))
{
    $msg .= "<h3>OOPS!  It looks like you did not enter a valid email address...</h3>\n";
}

if(isset($email) AND (!IsInjected($email)))
{

    $sql = "SELECT * FROM userlocation WHERE email = '".$email."'";
    $result = mysql_query($sql);
    $num=mysql_num_rows($result);

    if($num > 0) {

        $msg .= "ERROR: Email already exists. Please contact <a href=\"mailto:support@maproute.me?Subject=Reset%20My%20Password\">support</a><br>\n";

    } else {
        include "generate_password.php";
        $password = generatePassword(9,4);

        $sql = "INSERT INTO `locate`.`userlocation` ( `email` , `password` , `lat` , `long` , `lastUpdated` ) ".
            "VALUES ('$email',  '$password', NULL , NULL , NULL)";
        $result = mysql_query($sql);

        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

        $headers = "From: contact@maproute.me \r\n";
        $headers .= "Reply-To: $email \r\n";

        $subject = "Thank you for signing up for maproute.me!\n";
        $body = "Please keep the following information safe.\n\n".
            "Email: $email \n".
            "Password: $password \n".
            "Login URL: http://maproute.me/login.php";

        mail($email, $subject, $body, $headers);

        $msg .= "<h3>Thank you for signing up!</h3>\n";
        $msg .= "<p>A generated password has been sent to the email provided. Don't forget to check your spam.</p>\n";

        # Generate an email for us.
        $subject_int = "A user  signed up for maproute.me:\n";

        $body_int = "Email: $email \n\nIP: $ip\n";

        #   mail( to, subject, body, headers/from);
        mail("info@maproute.me",$subject_int,$body_int,$headers);
    }
}
?>

<div class="wrapper wrapper-style4 wrapper-first">
    <article id="contact">
        <header>
            <h2>Sign Up</h2>
            <?php
            if(strlen($msg)>0) {
                echo "<br>\n";
                echo $msg;
            }
            ?>
        </header>
        <div class="5grid">
            <div class="row">
                <div class="12u">
                    <form method="POST" action=""">
                        <div class="5grid">

                            <div class="row">
                                <div class="12u">
                                    <input type="email" name="email" id="email" placeholder="email@example.com" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="12u">
                                    <textarea name="tos" id="tos" readonly=readonly placeholder="Terms of Service."></textarea>
                                </div>
                            </div>
                            A password will be sent to the email provided.
                            <div class="row">
                                <div class="12u">
                                    <input type="submit" class="button" value="Sign Up" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </article>
</div>
<?php
include "footer.php";
?>
</body>
</html>
