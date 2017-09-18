<?php
// Rodomos prisijungimo klaidos 
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="lt"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="lt"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="lt"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="lt"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- ===========================
    INFORMACIJA
    =========================== -->    
    <meta name="description" content="KALĖDINIS LOTO, Registruok pirkimo kvitą ir laimėk vertingus prizus">
    <meta name="keywords" content="Kalėdos, Kalėdinis, loterija, loto">
        
    <!-- ===========================
    PUSLAPIO PAVADINIMAS
    =========================== -->
    <title>LOTERIJA - Prisijungti</title>
    
    <!-- ===========================
    FAVICONS
    =========================== -->
    <link rel="icon" href="img/favicon.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-ipad-retina.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-iphone-retina.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-ipad.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-iphone.png" />
    
    <!-- ===========================
    CSS
    =========================== --> 
    <link rel="stylesheet" href="css/loginform.css">
			
</head>
<body>

<!-- Prisijungimo forma -->
<section class="container">
  <div class="login">
      <h1>PRISIJUNGTI</h1>
	<form method="post" action="duom.php" name="loginform">
		<p><b>VARTOTOJO VARDAS</b> (test)</p>
		<p><input type="text" name="user_name" required /></p>
		<p><b>SLAPTAŽODIS</b> (testtest)</p>
		<p><input type="password" name="user_password" autocomplete="off" required /></p>
		<p class="submit"><input type="submit"  name="login" value="Prisijungti"/></p>
	</form>
  </div>
	<div class="login-help">
		<p><a href="register.php">Sukurti paskyrą</a></center></p>
	</div>
</section>	

</body>
</html>