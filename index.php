<?php
include("html5head.php");
if(!isset($_SESSION)) { session_start(); }
?>

<body>

<?php
include("menu.php");
?>
<!-- Home -->
<div class="wrapper wrapper-style1 wrapper-first">
    <article class="5grid-layout" id="top">
        <div class="row">
            <div class="4u">
                <span class="me image image-full"><img src="images/map.png" alt="" /></span>
            </div>
            <div class="8u">
                <header>
                    <h1>Welcome to <strong>MapRoute.me</strong></h1>
                </header>
                <p>
                    This is a simple <strong>GPS Tracking Application</strong> to let you share
                    your location with anyone you want.  It's an <strong>HTML5</strong> application
                    that works on any smart phone.  Your GPS information is sent to a database so
                    it can be shared with anyone you want!
                </p>
                <a href="signup.php" class="button button-big">Sign Up</a>
            </div>
        </div>
    </article>
</div>

<a name="howitworks"></a>
<div class="wrapper wrapper-style2">
    <article id="work">
        <header>
            <h2>How it works:</h2>
						<span>Sign Up. Login. Share.</span>
        </header>
        <div class="5grid-layout">
            <div class="row">
                <div class="4u">
                    <section class="box box-style1">
                        <span class="image image-centered"><img src="images/login.png" alt="" /></span>
                        <h3>Sign Up with your email address, then login.</h3>
                        <p>A password and login instructions will be sent to the email provided.
                        Login and allow the site access to your location.</p>
                        <hr>
                    </section>
                </div>
                <div class="4u">
                    <section class="box box-style1">
                        <span class="image image-centered"><img src="images/share.png" alt="" /></span>
                        <h3>Share the link with friends and family</h3>
                        <p>Click the SHARE button and send the link to anyone you need to.
                        This eliminates the constant 'where are you' questions and allows
                        anyone with internet access (and your link) to be able to watch.</p>
                        <hr>
                    </section>
                </div>
                <div class="4u">
                    <section class="box box-style1">
                        <span class="image image-centered"><img src="images/work03.png" alt="" /></span>
                        <h3>Knowlege is Power</h3>
                        <p>You have the power to update as often as you want, and anyone following you
                        has the safety of knowing your location</p>
                    </section>
                </div>
            </div>
        </div>
        <footer>
            <p>This was created because Google Latitude&reg was retired.</p>
        </footer>
    </article>
</div>


<?php
include "footer.php";
?>

</body>
</html>
