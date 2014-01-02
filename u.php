<?php
error_reporting(E_ALL);

#   u.php?EMAIL=jclark102@gmail.com&LAT=48.8567&LONG=2.3508

if(isset($_REQUEST['EMAIL']) AND isset($_REQUEST['LAT']) AND isset($_REQUEST['LONG']))
{
    #echo "isset <br>\n";
    include("connect.php");

    $email = $_REQUEST['EMAIL'];
    $lat = $_REQUEST['LAT'];
    $long = $_REQUEST['LONG'];

    $sql = "SELECT * FROM `locate`.`userlocation` WHERE `email` = '".$email."'";
    $result = mysql_query($sql);
    $num=mysql_num_rows($result);

    #echo "SQL: $sql [$num]<br>\n";

    #if($result) # User exists
    if($num>0)
    {   
        #echo "UPDATE <br>\n";

        # UPDATE  `locate`.`userlocation` SET `lat` = '44.9108', `long` = '-116.1031' WHERE `userlocation`.`uid` =1;
        $sql = "UPDATE `locate`.`userlocation` SET `lat` = '$lat', `long` = '$long', `lastUpdated` = NOW() WHERE `userlocation`.`email` = '$email'";
        $result = mysql_query($sql);

        #echo "SQL: $sql <br>\n";

        if($result) # User exists
        {   
            echo "Last Updated: ".date("D M j G:i:s T Y");
        } 
        else { echo "ERROR: ".mysql_error()." <br>\n"; }
    }
    else
    {
        #echo "INSERT <br>\n";

        # INSERT INTO  `locate`.`userlocation` ( `uid` , `name` , `email` , `password` , `lat` , `long` )
        #     VALUES ( NULL ,  'Jay',  'jclark102@gmail.com',  'jc102', NULL , NULL);
        #$sql = "INSERT INTO  `locate`.`userlocation` ( `uid` , `name` , `email` , `password` , `lat` , `long` )".
               #" VALUES ( NULL ,  'Name',  '$email', 'password', '$lat', '$long' );";

        $sql = "INSERT INTO  `locate`.`userlocation` ( `email` , `lat` , `long`, `lastUpdated` ) VALUES ( '$email', '$lat', '$long', NOW() );";

        #echo "SQL: $sql <br>\n";

        $result = mysql_query($sql);

        if($result) # Insert worked.
        {   
            echo "Last Updated: ".date("D M j G:i:s T Y");
        } 
        else { echo "ERROR: ".mysql_error()." <br>\n"; }
    }
}

#echo "DONE <br>\n";

?>
