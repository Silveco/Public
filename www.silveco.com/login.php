<?php

$pgLng="sl-SI";
$pgKeywords="Tiskarna, Silveco, tiskarna silveco, tisk, oblikovanje, grafična priprava, spletno oblikovanje, replikacija CD, CDji, izdelava CDjev, Izdelava DVDjev, replikacija DVDjev, grafično oblikovanje, spletno gostovanje";
$pgDesc="";
$pgTitle="Silveco Tiskarna";
$pgAuthor="Silveco Web Design Studio"

?>


<?php include 'parts/header.php';?>
<?php include 'parts/menu.php';?>

<!-- ----------------------- START login form HERE ----------------------- -->



<?php
//include config
require_once('includes/config.php');

//check if already logged in move to home page
if( $user->is_logged_in() ){ header('Location: index.php'); }

//process login form if submitted
if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($user->login($username,$password)){
        $_SESSION['username'] = $username;
        header('Location: memberpage.php');
        exit;

    } else {
        $error[] = 'Napačen uporabnik, email ali pa račun še ni bil aktiviran.';
    }

}//end if submit


?>



<!-- ----------------------- START PAGE HTML HERE ----------------------- -->








    <!-- Page Content -->
<!-- SECTION A -->
	<a  name="services"></a>
    <div class="content-section-a front-page">
        <div class="container">

            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <form role="form" method="post" action="" autocomplete="off">
                    <h2>Prijava v sistem</h2>
                    <p><a href='./'>Nazaj na domačo stran</a></p>
                    <hr>

                    <?php
                    //check for any errors
                    if(isset($error)){
                        foreach($error as $error){
                            echo '<p class="bg-danger">'.$error.'</p>';
                        }
                    }

                    if(isset($_GET['action'])){

                        //check the action
                        switch ($_GET['action']) {
                            case 'active':
                                echo "<h2 class='bg-success'>Vaš račun je aktiven, lahko se prijavite.</h2>";
                                break;
                            case 'reset':
                                echo "<h2 class='bg-success'>Povezava za resetiranje je bila poslana na vaš email naslov.</h2>";
                                break;
                            case 'resetAccount':
                                echo "<h2 class='bg-success'>Geslo je bilo spremenjeno, lahko se prijavite.</h2>";
                                break;
                        }

                    }


                    ?>

                    <div class="form-group">
                        <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Uporabniško ime" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Geslo" tabindex="3">
                    </div>

                    <div class="row">
                        <div class="col-xs-9 col-sm-9 col-md-9">
                            <a href='reset.php'>Pozabljeno geslo?</a>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Prijava" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
                    </div>
                </form>
            </div>




        </div>

    </div>







<!-- ----------------------- END PAGE HTML HERE ----------------------- -->

<?php include 'parts/footer.php';?>


