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


//if form has been submitted process it
if(isset($_POST['submit'])){

    //email validation
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $error[] = 'Prosimo vnesite veljaven email naslov.';
    } else {
        $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
        $stmt->execute(array(':email' => $_POST['email']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($row['email'])){
            $error[] = 'Vnešen email ne obstaja v bazi.';
        }

    }

    //if no errors have been created carry on
    if(!isset($error)){

        //create the activasion code
        $token = md5(uniqid(rand(),true));

        try {

            $stmt = $db->prepare("UPDATE members SET resetToken = :token, resetComplete='No' WHERE email = :email");
            $stmt->execute(array(
                ':email' => $row['email'],
                ':token' => $token
            ));

            //send email
            $to = $row['email'];
            $subject = "Password Reset";
            $body = "<p>Nekdo je zahteval resetiranje gesla za www.silveco.com.</p>
		    <p>Za resetiranje gesla kliknite na povezavo: <a href='".DIR."resetPassword.php?key=$token'>".DIR."resetPassword.php?key=$token</a></p>";

            $mail = new Mail();
            $mail->setFrom(SITEEMAIL);
            $mail->addAddress($to);
            $mail->subject($subject);
            $mail->body($body);
            $mail->send();

            //redirect to index page
            header('Location: login.php?action=reset');
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
                <form role="form" method="post" action="" autocomplete="off">
                    <h2>Ponastev gesla</h2>
                    <p><a href='login.php'>Nazaj na prijavo</a></p>
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
                                echo "<h2 class='bg-success'>Prosimo preverite vaš email za povezavo do ponastavitve gesla.</h2>";
                                break;
                        }
                    }
                    ?>

                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email" value="" tabindex="1">
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Potrdi" class="btn btn-primary btn-block btn-lg" tabindex="2"></div>
                    </div>
                </form>
            </div>




        </div>

    </div>







<!-- ----------------------- END PAGE HTML HERE ----------------------- -->

<?php include 'parts/footer.php';?>


