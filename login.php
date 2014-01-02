<?php
// Just remove any session stuff and start over.
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
		<title>Login</title>
        <?php
        include("html5head.php");
        ?>
	</head>
	<body>


<?php
include("menu.php");
include("connect.php");

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

#if(isset($_REQUEST["email"])) { $email = mysql_real_escape_string($_REQUEST["email"]); }
#if(isset($_REQUEST["password"])) { $pass = mysql_real_escape_string($_REQUEST["password"]); }

$email = mysql_real_escape_string($_REQUEST["email"]);
$pass = mysql_real_escape_string($_REQUEST["password"]);

if((strlen($email)>0) AND IsInjected($email))
{
    $msg .= "<h3>OOPS!  It looks like you did not enter a valid email address...</h3>\n";
}

if(isset($email) AND (!IsInjected($email)) AND isset($pass))
{

  $sql = "SELECT * FROM userlocation WHERE email = '".$email."' AND password = '".$pass."'";
  $result = mysql_query($sql);
  $num=mysql_num_rows($result);

  if($num > 0) {
    # Validate their name, email, and password.
    $_SESSION["EMAIL"] = $email;
    $_SESSION["PASSWORD"] = $pass;
    
    header("location:/update.php");
  
    $msg .= "INDEX.PHP<br>\n";
  
  } else {
    $msg .= "<h3>OOPS. Invalid username or password...</h3>\n";
  }
}

?>
      <div class="wrapper wrapper-style4 wrapper-first">
        <article id="contact">
          <header>
            <h2>Login</h2>
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
              <form method="POST" action="">
                <div class="5grid">

                  <div class="row">
                    <div class="12u">
                      <input type="email" name="email" id="email" placeholder="email@example.com" />
                    </div>
                  </div>

                  <div class="row">
                    <div class="12u">
                      <input type="password" name="password" id="password" placeholder="Password" />
                    </div>
                  </div>

                  <div class="row">
                    <div class="12u">
                      <textarea name="tos" id="tos" readonly=readonly placeholder="Terms of Service."></textarea>
                    </div>
                  </div>

                  <div class="row">
                    <div class="12u">
                      <input type="submit" class="button" value="Login" />
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
