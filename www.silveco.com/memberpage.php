
<?php require('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

//define page title
$title = 'Spletni dostop';

//include header template
include 'parts/header.php';
?>

<?php

$pgLng="sl-SI";
$pgKeywords="Tiskarna, Silveco";
$pgDesc="O podjetju Silveco d.o.o.";
$pgTitle="O nas - Silveco Tiskarna";
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
                    <p><a href='logout.php'>Odjava</a></p>
                    <hr>

                </div>
            </div>

        </div>


    </div>





<!-- ----------------------- END PAGE HTML HERE ----------------------- -->

<?php include 'parts/footer.php';?>


