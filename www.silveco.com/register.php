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



<?php require('includes/config.php');

//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); }

//if form has been submitted process it
if(isset($_POST['submit'])){

    //very basic validation
    if(strlen($_POST['username']) < 3){
        $error[] = 'Username is too short.';
    } else {
        $stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
        $stmt->execute(array(':username' => $_POST['username']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($row['username'])){
            $error[] = 'Username provided is already in use.';
        }

    }

    if(strlen($_POST['password']) < 3){
        $error[] = 'Password is too short.';
    }

    if(strlen($_POST['passwordConfirm']) < 3){
        $error[] = 'Confirm password is too short.';
    }

    if($_POST['password'] != $_POST['passwordConfirm']){
        $error[] = 'Passwords do not match.';
    }

    //email validation
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $error[] = 'Please enter a valid email address';
    } else {
        $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
        $stmt->execute(array(':email' => $_POST['email']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($row['email'])){
            $error[] = 'Email provided is already in use.';
        }

    }


    //if no errors have been created carry on
    if(!isset($error)){

        //hash the password
        $hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

        //create the activasion code
        $activasion = md5(uniqid(rand(),true));

        try {

            //insert into database with a prepared statement
            $stmt = $db->prepare('INSERT INTO members (username,password,email,active) VALUES (:username, :password, :email, :active)');
            $stmt->execute(array(
                ':username' => $_POST['username'],
                ':password' => $hashedpassword,
                ':email' => $_POST['email'],
                ':active' => $activasion
            ));
            $id = $db->lastInsertId('memberID');

            //send email
            $to = $_POST['email'];
            $subject = "Registration Confirmation";
            $body = "<p>Thank you for registering at demo site.</p>
			<p>To activate your account, please click on this link: <a href='".DIR."activate.php?x=$id&y=$activasion'>".DIR."activate.php?x=$id&y=$activasion</a></p>
			<p>Regards Site Admin</p>";

            $mail = new Mail();
            $mail->setFrom(SITEEMAIL);
            $mail->addAddress($to);
            $mail->subject($subject);
            $mail->body($body);
            $mail->send();

            //redirect to index page
            header('Location: index.php?action=joined');
            exit;

            //else catch the exception and show the error.
        } catch(PDOException $e) {
            $error[] = $e->getMessage();
        }

    }

}


?>



<!-- ----------------------- START PAGE HTML HERE ----------------------- -->








    <!-- Page Content -->
<!-- SECTION A -->
	<a  name="services"></a>
    <div class="content-section-a front-page">
        <div class="container">

            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <form role="form" method="post" action="" autocomplete="off">
                    <h2>Registracija uporabnika</h2>
                    <p class="lead">Ste že registrirani? <a href='login.php'>Prijava</a></p>
                    <hr>

                    <?php
                    //check for any errors
                    if(isset($error)){
                        foreach($error as $error){
                            echo '<p class="bg-danger">'.$error.'</p>';
                        }
                    }

                    //if action is joined show sucess
                    if(isset($_GET['action']) && $_GET['action'] == 'joined'){
                        echo "<h2 class='bg-success'>Registracija je bila uspešna! Prosimo preverite vaš email za aktivacijo računa.</h2>";
                    }
                    ?>

                    <div class="form-group">
                        <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Uporabniško ime" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Naslov" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="2">
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Geslo" tabindex="3">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Ponovi geslo" tabindex="4">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Potrdi" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
                    </div>
                </form>
            </div>




        </div>

    </div>







<!-- ----------------------- END PAGE HTML HERE ----------------------- -->

<?php include 'parts/footer.php';?>


