<?php
if(strlen($_SESSION['EMAIL'])<1) {
    # Public facing.
    echo "      <!-- Nav -->\n";
    echo "      <nav id=\"nav\">\n";
    echo "          <ul>\n";
    echo "              <li><a href=\"index.php\">Home</a></li>\n";
    echo "              <li><a href=\"signup.php\">Sign Up</a></li>\n";
    echo "              <li><a href=\"login.php\">Login</a></li>\n";
    echo "          </ul>\n";
    echo "      </nav>\n";
}
else
{
    echo "      <!-- Nav -->\n";
    echo "      <nav id=\"nav\">\n";
    echo "          <ul>\n";
    echo "              <li><a href=\"index.php\">Home</a></li>\n";
    echo "              <li><a href=\"update.php\">Update</a></li>\n";
    echo "              <li><a href=\"show.php?EMAIL=".$_SESSION['EMAIL']."\" target=\"_blank\">SHARE</a></li>\n";
    echo "              <li><a href=\"login.php\">Logout</a></li>\n";
    echo "          </ul>\n";
    echo "      </nav>\n";
}
?>