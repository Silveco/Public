
<?php
require('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }


//include header template
include 'parts/header.php';
?>

<?php

$pgLng="sl-SI";
$pgKeywords="Tiskarna, Silveco";
$pgDesc="O podjetju Silveco d.o.o.";
$pgTitle="User - Silveco Tiskarna";
$pgAuthor="Silveco Web Design Studio"

?>



<?php include 'parts/menu.php';?>



<!-- ----------------------- START PAGE HTML HERE ----------------------- -->

    <div class="intro-header"></div>

    <div class="content-section-a">
        <div class="container">

            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

                    <h2>Dobrodošel/a <?php echo $_SESSION['username']; ?></h2>


                    <div class="user-links">
                        <div class="col-xs-12 col-sm-6 col-md-3 ">
                            <a href="https://host20.registrar-servers.com:2083/" target="_blank" class="u-link">
                                <img src="/img/CPanel_logo.png" />
                                <p>Prijava v CPanel</p>
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 ">
                            <a href="https://host20.registrar-servers.com:2096/" target="_blank" class="u-link">
                                <img src="/img/mail_edit.png" />
                                <p>Prijava v Webmail</p>
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 ">
                            <a href="http://files.silveco.si/" target="_blank" class="u-link">
                                <img src="/img/folder.svg" />
                                <p>Upravljalec datotek</p>
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 ">
                            <a href="http://app.silveco.si/index.php?controller=authentication" target="_blank" class="u-link">
                                <img src="/img/users.png" />
                                <p>Partnerji Dostop</p>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <!-- <p><a href='logout.php'>Odjava</a></p> -->

                </div>
            </div>

        </div>


    </div>





<!-- ----------------------- END PAGE HTML HERE ----------------------- -->

<?php include 'parts/footer.php';?>


