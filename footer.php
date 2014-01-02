<?php
$Y = date('Y',time());
?>

<div class="wrapper wrapper-style4">

    <article id="contact">
        <!--
        <header>
            <h2>Get in touch!</h2>
            <span>Links to all social media below!</span>
        </header>
        -->
        <div class="5grid">
            <!--
                Comment out contact form for now.
            <div class="row">
                <div class="12u">
                    <form method="post" action="#">
                        <div class="5grid">
                            <div class="row">
                                <div class="6u">
                                    <input type="text" name="name" id="name" placeholder="Name" />
                                </div>
                                <div class="6u">
                                    <input type="text" name="email" id="email" placeholder="Email" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="12u">
                                    <input type="text" name="subject" id="subject" placeholder="Subject" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="12u">
                                    <textarea name="message" id="message" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="12u">
                                    <input type="submit" class="button" value="Send Message" />
                                    <input type="reset" class="button button-alt" value="Clear Form" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            -->
            <div class="row row-special">
                <div class="12u">
                    <h3>Find me on ...</h3>
                    <ul class="social">
                        <li class="facebook"><a href="#">Facebook</a></li>
                        <li class="twitter"><a href="http://twitter.com/">Twitter</a></li>
                        <li class="dribbble"><a href="http://dribbble.com/">Dribbble</a></li>
                        <li class="linkedin"><a href="#">LinkedIn</a></li>
                        <li class="tumblr"><a href="#">Tumblr</a></li>
                        <li class="googleplus"><a href="#">Google+</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <footer>
            <p id="copyright">
                &copy; <?php echo $Y; ?> Powered By: <a href="http://maproute.me">MapRoute.me</a>
            </p>
        </footer>
    </article>
</div>