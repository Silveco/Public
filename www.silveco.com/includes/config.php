
<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('Europe/London');

//database credentials
define('DBHOST','localhost');
define('DBUSER','silvec0_users');
define('DBPASS','UHGMUTz90aRd');
define('DBNAME','silvec0_users');

//application address
define('DIR','http://www.silveco.com/');
define('SITEEMAIL','noreply@silveco.com');

try {

	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";port=8889;dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('classes/user.php');
include('classes/phpmailer/mail.php');
$user = new User($db);
?>
