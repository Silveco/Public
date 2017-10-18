<?php
//include config
require_once('includes/config.php');
//check if already logged in move to home page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); }
?>




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
$stmt = $db->prepare('SELECT resetToken, resetComplete FROM members WHERE resetToken = :token');
$stmt->execute(array(':token' => $_GET['key']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//if no token from db then kill the page
if(empty($row['resetToken'])){
    $stop = 'Invalid token provided, please use the link provided in the reset email.';
} elseif($row['resetComplete'] == 'Yes') {
    $stop = 'Your password has already been changed!';
}

//if form has been submitted process it
if(isset($_POST['submit'])){

    //basic validation
    if(strlen($_POST['password']) < 3){
        $error[] = 'Password is too short.';
    }

    if(strlen($_POST['passwordConfirm']) < 3){
        $error[] = 'Confirm password is too short.';
    }

    if($_POST['password'] != $_POST['passwordConfirm']){
        $error[] = 'Passwords do not match.';
    }

    //if no errors have been created carry on
    if(!isset($error)){

        //hash the password
        $hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

        try {

            $stmt = $db->prepare("UPDATE members SET password = :hashedpassword, resetComplete = 'Yes'  WHERE resetToken = :token");
            $stmt->execute(array(
                ':hashedpassword' => $hashedpassword,
                ':token' => $row['resetToken']
            ));

            //redirect to index page
            header('Location: login.php?action=resetAccount');
            exit;

            //else catch the exception and show the error.
        } catch(PDOException $e) {
            $error[] = $e->getMessage();
        }

    }

}

//define page title
$title = 'Reset Account';


?>





<!-- ----------------------- START PAGE HTML HERE ----------------------- -->

g<!-- Page Content -->
<!-- SECTION A -->
	<a  name="services"></a>
    <div class="content-section-a front-page">
        <div class="container">

            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">


                <?php if(isset($stop)){

                    echo "<p class='bg-danger'>$stop</p>";

                } else { ?>

                    <form role="form" method="post" action="" autocomplete="off">
                        <h2>Spremeni geslo</h2>
                        <hr>

                        <?php
                        //check for any errors
                        if(isset($error)){
                            foreach($error as $error){
                                echo '<p class="bg-danger">'.$error.'</p>';
                            }
                        }

                        //check the action
                        switch ($_GET['action']) {
                            case 'active':
                                echo "<h2 class='bg-success'>Vaš račun je aktiven, lahko se prijavite.</h2>";
                                break;
                            case 'reset':
                                echo "<h2 class='bg-success'>Prosimo preverite vaš email za povezavo do resetiranja gesla.</h2>";
                                break;
                        }
                        ?>

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Novo Geslo" tabindex="1">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Ponovi Geslo" tabindex="1">
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Spremeni Geslo" class="btn btn-primary btn-block btn-lg" tabindex="3"></div>
                        </div>
                    </form>

                <?php } ?>
            </div>




        </div>

    </div>







<!-- ----------------------- END PAGE HTML HERE ----------------------- -->

<?php include 'parts/footer.php';?>


